<?php

use Illuminate\Database\Seeder;

use App\Staff;

class staffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('staff')->truncate();

    	Staff::create(array(
    		'fname'         => 'Umaha',
    		'lname'         => 'Tokula',
    		'email'         => 'umahatokula@ovalsofttechnologies.com',
    		'phone'         => '08055271439',
    		'address'      	=> 'No 7 Canaan Str, GRA, Gboko, Benue State',
    		'gender_id'    	=> '1',
    		'staff_type_id' => '1',
    		'country_id' 	=> '162',
    		'state_id' 		=> '1',
    		'local_id' 		=> '1',
    		));

    	$faker = Faker\Factory::create();

    	$limit = 30;

    	for ($i = 0; $i < $limit; $i++) {
    		Staff::create([ 
    			'fname' 			=> $faker->firstName,
    			'lname' 			=> $faker->lastName,
    			'email' 			=> $faker->unique()->email,
    			'phone' 			=> $faker->phoneNumber,
    			'address' 			=> $faker->address,
    			'gender_id' 		=> $faker->numberBetween($min = 1, $max = 2),
    			'staff_type_id' 	=> $faker->numberBetween($min = 1, $max = 2),
    			'country_id' 		=> $faker->numberBetween($min = 1, $max = 240),
    			'state_id' 			=> $faker->numberBetween($min = 1, $max = 36),
    			'local_id' 			=> $faker->numberBetween($min = 1, $max = 700)
    			]);
    	}
    }

}