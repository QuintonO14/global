<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,1000) as $index) {
            DB::table('users')->insert([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'status' => $faker->text(100),
                'country_living' => $faker->country,
                'country_from' => $faker->country,
                'job' => $faker->company,
                'gender' => $faker->randomElement($array = array ('Male', 'Female')) ,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }


    }
}
