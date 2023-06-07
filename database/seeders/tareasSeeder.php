<?php

namespace Database\Seeders;
use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class tareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $tableros = DB::table('tableros')->pluck('id');

        foreach ($tableros as $tablero) {
            DB::table('tareas')->insert([
                'tablero_id' => $tablero,
                'Fecha_inicio' => $faker->date(),
                'Fecha_fin' => $faker->date(),
                'Responsables' => $faker->sentence(),
                'Tarea' => $faker->sentence(),
                
                // Otros campos de la tabla nomina
            ]);
        }
    }
}
