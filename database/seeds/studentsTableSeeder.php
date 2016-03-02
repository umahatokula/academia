<?php

use Illuminate\Database\Seeder;

class studentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->truncate();

        $faker = Faker\Factory::create();

        $limit = 200;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('students')->insert([ 
                'fname' => $faker->firstName,
                'lname' => $faker->lastName,
                'mname' => $faker->randomLetter,
                'parent_id' => $faker->numberBetween($min = 1, $max = 50),
                'class_id' => $faker->numberBetween($min = 1, $max = 8),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'height' => $faker->randomDigitNotNull,
                'weight' => $faker->randomDigitNotNull,
                'gender_id' => $faker->numberBetween($min = 1, $max = 2),
                'country_id' => $faker->numberBetween($min = 1, $max = 240),
                'state_id' => $faker->numberBetween($min = 1, $max = 36),
                'local_id' => $faker->numberBetween($min = 1, $max = 700),
                'religion_id' => $faker->numberBetween($min = 1, $max = 4),
                'blood_group_id' => $faker->numberBetween($min = 1, $max = 4),
            ]);
        }
    }
}
