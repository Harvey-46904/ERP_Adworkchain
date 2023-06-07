<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use DB;
use Illuminate\Database\Seeder;

class tablerosSeeder extends Seeder
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
            DB::table('tableros')->insert([
                'Nombre' => $faker->name(),
                'Imagen' => $faker->name(),
            ]);
        }
    }
}
