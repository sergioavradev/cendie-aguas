<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Crear permisos
        $permissionCrearUsuario = Permission::create(['name' => 'create user']);
        $permissionEditarUsuario = Permission::create(['name' => 'edit user']);
        $permissionEliminarUsuario = Permission::create(['name' => 'delete user']);
        $permissionVerUsuario = Permission::create(['name' => 'view user']);
        
        $permissionCrearPost = Permission::create(['name' => 'create form']);
        $permissionEditarPost = Permission::create(['name' => 'edit form']);
        $permissionEliminarPost = Permission::create(['name' => 'delete form']);
        $permissionVerPost = Permission::create(['name' => 'view form']);
        
        $permissionCrearRol = Permission::create(['name' => 'create role']);
        $permissionEditarRol = Permission::create(['name' => 'edit role']);
        $permissionEliminarRol = Permission::create(['name' => 'delete role']);
        $permissionVerRol = Permission::create(['name' => 'view role']);
        
        $permissionCrearCategoria = Permission::create(['name' => 'create region']);
        $permissionEditarCategoria = Permission::create(['name' => 'edit region']);
        $permissionEliminarCategoria = Permission::create(['name' => 'delete region']);
        $permissionVerCategoria = Permission::create(['name' => 'view region']);
        
        $permissionGestionarConfiguracion = Permission::create(['name' => 'manage settings']);
        $permissionVerPanelControl = Permission::create(['name' => 'view dashboard']);
        $permissionExportarDatos = Permission::create(['name' => 'export data']);
        $permissionImportarDatos = Permission::create(['name' => 'import data']);
        $permissionGenerarInformes = Permission::create(['name' => 'generate reports']);
        
    }
}
