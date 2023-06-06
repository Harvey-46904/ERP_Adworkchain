<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class EmpleadosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Crea 10 registros de ejemplo
        for ($i = 0; $i < 10; $i++) {
            DB::table('empleados')->insert([
                'Nombre_completo' => $faker->name,
                'Cedula' => $faker->numerify('########'),
                'Cargo' => $faker->jobTitle,
                'Fecha_ingreso' => $faker->date,
                'Fecha_finalizacion' => $faker->date,
                'Email' => $faker->email,
                'Telefono_personal' => $faker->phoneNumber,
                'Contacto_emergencia' => $faker->name,
                'Numero_contacto_emergencia' => $faker->phoneNumber,
            ]);
        }
    }
}
