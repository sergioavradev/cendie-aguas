<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {

       // Validación de los datos
           $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'regiones' => 'required|array',
            'rol' => 'required',
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'email.required' => 'El campo Email es obligatorio.',
            'email.email' => 'El campo Email debe ser una dirección de correo válida.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'regiones.required' => 'Selecciona al menos una región.',
            'rol.required' => 'Selecciona un rol.',
        ]);

        try {    
    
            // Crear un nuevo usuario en la base de datos
            $usuario = new User();
            $usuario->name = $request->input('nombre');
            $usuario->email = $request->input('email');
            $usuario->password = bcrypt($request->input('password'));
            // ... Completa con los demás campos

            $usuario->save();

            // Asociar regiones y rol
            $usuario->regiones()->attach($request->input('regiones'));
            $usuario->attachRole($request->input('rol'));

            return response()->json(['success' => true, 'message' => 'Usuario creado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ocurrió un error al crear el usuario: ' . $e->getMessage()]);
        }

        // return redirect()->route('listadoUsuarios')->with('status', 'Usuario creado exitosamente.');

    }

    public function updateData(Request $request,$id)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Actualización de usuario
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('userSetting')->with('status', 'Edición exitosa.');

    }

    function update(Request $request,$id)
    {

        $user = User::find($id);
        $user->name = $request->input('nombreActualizar');
        $user->email = $request->input('emailActualizar');
        $user->save();
        $rolViejo = $user->roles[0];
        $regionesViejo = $user->regiones;

        //  Desasociar regiones y rol
         $user->detachRole($rolViejo->name); 
         foreach ($regionesViejo as $region) {
            $user->regiones()->detach([$region->id]);
         }
        
        // Asociar regiones y rol
         $user->attachRole($request->input('rolActualizar'));
         $user->regiones()->attach($request->input('regionesActualizar'));


        
        return redirect()->route('listadoUsuarios')->with('status', 'Edición exitosa.');

        
        
    }

    function get($id){
        $usuario = User::find($id);
        $roles = $usuario->roles;
        $regiones = $usuario->regiones;
        return response()->json($usuario);

    }




    public function listUsers()
    {
        $user = Auth::user();
        $users = User::whereNotIn('id', [$user->id])->get();
        return response()->json($users);
    }
    public function eliminarUser(Request $request,$id)
    {
        $registro = User::find($id);
        $registro->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
    
    
}
