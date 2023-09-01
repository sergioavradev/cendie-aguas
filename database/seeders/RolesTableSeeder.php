<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // Crear roles
           $roleAdmin = Role::create(['name' => 'Administrador']);
           $roleVisador = Role::create(['name' => 'Visador']);
           $roleTecnico = Role::create(['name' => 'Técnico Laboratorio']);
    }
}
