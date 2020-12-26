<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;


class SettingSeeder extends Seeder
{

    public function run()
	{
        $faker = Factory::create();

        $formatters = [
            'company_name' => $faker->name,
            'about_us'     => $faker->sentence(3),
            'mission'      => $faker->text,
            'vision'       => $faker->text,
            'logo'         => $faker->imageUrl(800, 400),
            'mobile_logo'  => $faker->imageUrl(200, 100),
            'favicon'      => $faker->imageUrl(25, 25),
            'phone_1'      => $faker->phoneNumber,
            'phone_2'      => $faker->e164PhoneNumber,
            'fax_1'        => $faker->phoneNumber,
            'fax_2'        => $faker->e164PhoneNumber,
            'email'        => $faker->email,
            'facebook'     => $faker->name,
            'twitter'      => $faker->name,
            'instagram'    => $faker->name,
            'linkedin'     => $faker->name,
            'created_at'   => $faker->dateTime('now')->format('Y-m-d-H:i:s'),
            'updated_at'   => $faker->dateTime('now')->format('Y-m-d-H:i:s'),

        ];

        $this->db->table('settings')->insert($formatters);



    }
}
