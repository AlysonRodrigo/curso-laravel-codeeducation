<?php

use Illuminate\Database\Seeder;
use CookieSoftCommerce\User;
use Faker\Factory as Faker;

class UserTableSeed extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        $faker = Faker::create();

        foreach (range(1,15) as $i){
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => Hash::make($faker->word())
            ]);
        }




    }


}