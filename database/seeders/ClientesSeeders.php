<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
class ClientesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('clientes')->insert([
                'Fecha_interaccion' => $faker->date(),
                'Nombre' => $faker->name(),
                'Telefono' => $faker->phoneNumber(),
                'Email' => $faker->email(),
                'Empresa' => $faker->company(),
                'Tipo_cliente' => $faker->randomElement(['Nuevo', 'Existente']),
                'Servicio' => $faker->word(),
                'Ultima_interaccion' => $faker->date(),
                'Estado' => $faker->randomElement(['Activo', 'Inactivo']),
                'Notas' => $faker->sentence()
            ]);
        }

    }
}
