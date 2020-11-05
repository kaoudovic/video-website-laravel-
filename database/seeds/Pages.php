<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class Pages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0 ;$i< 10 ;$i++){
            $array = [
                'name' => $faker->word,
                'meta_keywords' => $faker->name,
                'meta_des' => $faker->name,
                'des' => $faker->paragraph,
            ];
            \App\Models\Page::create($array);
        }
    }





}
