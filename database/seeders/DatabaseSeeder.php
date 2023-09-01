<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionsTableSeeder; 
use Database\Seeders\RegionesTableSeeder; 
use Database\Seeders\RolesTableSeeder; 
use App\Models\User;
use App\Models\Region;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuarios al azar
        \App\Models\User::factory(3)->create();

        // Ejecutar los semillas
        $this->call(PermissionsTableSeeder::class);
        $this->call(RegionesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        // Asignar regiones a un usuario
        $user = User::find(1);
        $region1 = Region::find(2);
        $region2 = Region::find(3);
        $region3 = Region::find(4);
        $user->regiones()->attach([$region1->id, $region2->id]);

        // Asignar roles a los usuarios
        $user = User::find(1); 
        $roleAdmin = Role::find(1);
        $user->attachRole($roleAdmin); 
        $user->email = 'danieltesorero2009@gmail.com';
        $user->save();

         // Asignar roles a los usuarios
         $user2 = User::find(2); 
         $roleAdmin2 = Role::find(2);
         $user2->attachRole($roleAdmin2); 
         $user2->regiones()->attach([$region1->id, $region3->id]);

          // Asignar roles a los usuarios
        $user3 = User::find(3); 
        $roleAdmin3 = Role::find(3);
        $user3->attachRole($roleAdmin3); 
        $user3->regiones()->attach([$region1->id, $region2->id]);

    }
}
