<?php

use Illuminate\Database\Seeder;

class parentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parents')->truncate();

        $faker = Faker\Factory::create();

        $limit = 50;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('parents')->insert([ 
                'fname' => $faker->firstName,
                'lname' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'address' => $faker->address,
                'occupation' => $faker->word,
                'gender_id' => $faker->numberBetween($min = 1, $max = 2),
                'country_id' => $faker->numberBetween($min = 1, $max = 240),
                'state_id' => $faker->numberBetween($min = 1, $max = 36),
                'local_id' => $faker->numberBetween($min = 1, $max = 700),
                'religion_id' => $faker->numberBetween($min = 1, $max = 4),
                'blood_group_id' => $faker->numberBetween($min = 1, $max = 4),
                'staff' => $faker->numberBetween($min = 0, $max = 1),
                ]);
        }
    }
}
