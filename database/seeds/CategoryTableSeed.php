<?php

use Illuminate\Database\Seeder;
use CookieSoftCommerce\Category;
use Faker\Factory as Faker;

class CategoryTableSeed extends Seeder
{

    public function run()
    {
        DB::table('categories')->truncate();

        $faker = Faker::create();

        foreach (range(1,15) as $i){
            Category::create([
                'name' => $faker->word(),
                'description' => $faker->sentence()
            ]);
        }




    }


}