<?php

use Illuminate\Database\Seeder;

use \App\studentClass;

class classesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('classes')->truncate();

        $faker = Faker\Factory::create();

        studentClass::create([
        	'name' => 'SSS 3A',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 3B',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 3C',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 2A',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 2B',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 2C',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 1A',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 1B',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'SSS 1C',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'JSS 3A',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'JSS 3B',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);

        studentClass::create([
        	'name' => 'JSS 3C',
        	'staff_id' => $faker->numberBetween($min = 2, $max = 10),
        	'max_students' => 30
        	]);
    }
}
