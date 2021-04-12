<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;
use DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Ana',
            'email' => 'anavisnia@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $faker = Faker::create();
        $betters = 10;
        $horses = 35;

        foreach(range(1, $horses) as $_) {
        DB::table('horses')->insert([
                'name' => $faker->firstName(),
                'runs' => rand(15, 30),
                'wins' => rand(1, 15),
                'about' => $faker->realText(400, 4),
            ]);
        }

        foreach(range(1, $betters) as $_) {
            DB::table('betters')->insert([
                    'name' => $faker->firstName(),
                    'surname' => $faker->lastName(),
                    'bet' => rand(1, 50),
                    'horse_id' => rand(1, $horses),
                ]);
            }
        
    }
}
