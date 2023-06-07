<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;
class nominasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $nominas = DB::table('contratos')->pluck('id');

        foreach ($nominas as $nomina) {
            DB::table('nominas')->insert([
                'id_contrato' => $nomina,
                'Fecha' => $faker->date(),
                'Monto' => $faker->randomFloat(2, 1000, 5000),
                'Acta' => $faker->sentence(),
                
                // Otros campos de la tabla nomina
            ]);
        }
    }
}