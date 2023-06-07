<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class contratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $empleados = DB::table('empleados')->pluck('id');

        foreach ($empleados as $empleado) {
            DB::table('contratos')->insert([
                'id_empleado' => $empleado,
                'Tiempo_Labo' => $faker->date(),
                'Pago' => $faker->randomFloat(2, 1000, 5000),
                'Estado' => $faker->sentence(),
                
                // Otros campos de la tabla nomina
            ]);
        }
    }
}
