<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Region;

class RegionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear Regiones
             // // Ejemplo de creación de una región nacional
        $regionNacional = Region::create([
            'nombre' => 'Argentina',
            'tipo' => 'nacional',
        ]);


        $provincias = [
            ['nombre' => 'Buenos Aires', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Catamarca', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Chaco', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Chubut', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Córdoba', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Corrientes', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Entre Ríos', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Formosa', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Jujuy', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'La Pampa', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'La Rioja', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Mendoza', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Misiones', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Neuquén', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Río Negro', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Salta', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'San Juan', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'San Luis', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Santa Cruz', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Santa Fe', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Santiago del Estero', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Tierra del Fuego', 'tipo' => 'provincial', 'id_padre' => 1],
            ['nombre' => 'Tucumán', 'tipo' => 'provincial', 'id_padre' => 1],
        ];

        foreach ($provincias as $provincia) {
            Region::create($provincia);
        }

    }
}
