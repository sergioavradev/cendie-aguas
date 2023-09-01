<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Formulario;

use App\Models\Campo;


class FormularioController extends Controller
{
    public function index()
    {
        $formularios = Formulario::all();
        return view('formularios.index', compact('formularios'));
    }

    public function create()
    {
        $formularios = Formulario::all();
        return view('formularios.create', compact('formularios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'campo_nombre' => 'required|array',
            'campo_tipo_dato' => 'required|array',
            'campo_obligatorio' => 'nullable|array',
        ]);
    
        $campoNombres = $request->input('campo_nombre');
        $campoTipos = $request->input('campo_tipo_dato');
        $campoObligatorios = $request->input('campo_obligatorio', []);
        $cantidadCampos = count($campoNombres);
        $descripcion  = $request->input('descripcion');;
      
        $formulario = new Formulario([
            'nombre' => $request->input('nombre'),
            'cantidad_campos' => $cantidadCampos,
            'descripcion' => $descripcion,
        ]);
        
        $formulario->save();
    
        foreach ($campoNombres as $index => $nombre) {
            $campoTipo = $campoTipos[$index];
            $campoObligatorio = isset($campoObligatorios[$index]) ? true : false;
    
            $validator = Validator::make(
                ['nombre' => $nombre, 'tipo' => $campoTipo],
                ['nombre' => 'required|string|max:255', 'tipo' => 'required']
            );
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            Campo::create([
                'formulario_id' => $formulario->id,
                'nombre' => $nombre,
                'tipo' => $campoTipo,
                'obligatorio' => $campoObligatorio,
                // Agrega más atributos del campo según tus necesidades
            ]);
        }
    
        return redirect()->route('formularios.index')->with('success', 'Formulario creado exitosamente.');
    }
    


    public function show($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('formularios.show', compact('formulario'));
    }


    public function edit($id)
    {
        $formulario = Formulario::findOrFail($id);
        return view('formularios.edit', compact('formulario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'campo_nombre' => 'required|array',
            'campo_tipo_dato' => 'required|array',
            'campo_obligatorio' => 'nullable|array',
        ]);
    
        $formulario = Formulario::findOrFail($id);
    
        $campoNombres = $request->input('campo_nombre');
        $campoTipos = $request->input('campo_tipo_dato');
        $campoObligatorios = $request->input('campo_obligatorio', []);
        $cantidadCampos = count($campoNombres);
    
        $formulario->nombre = $request->input('nombre');
        $formulario->descripcion = $request->input('descripcion');
        $formulario->cantidad_campos = $cantidadCampos;
        $formulario->save();
    
        // Eliminar campos existentes y luego crear los nuevos campos actualizados
        $formulario->campos()->delete();
    
        foreach ($campoNombres as $index => $nombre) {
            $campoTipo = $campoTipos[$index];
            $campoObligatorio = in_array($index, $campoObligatorios);
    
            Campo::create([
                'formulario_id' => $formulario->id,
                'nombre' => $nombre,
                'tipo' => $campoTipo,
                'obligatorio' => $campoObligatorio,
                // Agrega más atributos del campo según tus necesidades
            ]);
        }
    
        return redirect()->route('formularios.index')->with('success', 'Formulario actualizado exitosamente.');
    }
    

    public function destroy($id)
    {
        $formulario = Formulario::findOrFail($id);
        $formulario->delete();

        return redirect()->route('formularios.index')->with('success', 'Formulario eliminado exitosamente.');
    }

}
