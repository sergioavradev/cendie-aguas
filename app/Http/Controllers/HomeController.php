<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('home',compact('user'));
    }

    public function usuariosView()
    {   
        $user = Auth::user();
        $users = User::whereNotIn('id', [$user->id])->get();
        $regiones = Region::all();
        $roles = Role::all();
        return view('usuarios.listado',compact('regiones','roles'));
    }

    public function userSetting()
    {
        $user = Auth::user();

        return view('usuarios.userSetting',compact('user'));
    }

    function getRegiones(){
        $regiones = Region::all();
        return response()->json($regiones);
    }

}
