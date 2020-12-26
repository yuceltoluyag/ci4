<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;


class ServiceSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();


        for ($i = 0; $i < 20; $i++) {
            $formatters = [
                'url' => $faker->url,
                'title' => $faker->name,
                'description' => $faker->realText(),
                'price' => $faker->numberBetween(1,100),
                'image' => 'default.jpg',
                'isActive' => $faker->randomElement(['0', '1']),
                'created_at' => $faker->dateTime('now')->format('Y-m-d-H:i:s'),
                'updated_at' => $faker->dateTime('now')->format('Y-m-d-H:i:s'),
            ];
            $this->db->table('services')->insert($formatters);
        }



    }
}
