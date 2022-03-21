<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 500; $i++) {
            DB::table('clientes')->insert([
                'nome' => $faker->name,
                'email' => $faker->email,
                'telefone01' =>$faker->phoneNumber,
                'telefone02' =>$faker->phoneNumber
            ]);
        }

    }
}
