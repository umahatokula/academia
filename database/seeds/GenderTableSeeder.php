<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Gender;

class GenderTableSeeder extends Seeder {

public function run(){
	 	// DB::table('gender')->delete();
	 	DB::table('gender')->truncate();

		$male = Gender::create(array(
		            'gender'         => 'Male'
		        ));

		$female = Gender::create(array(
		            'gender'         => 'Female'
		        ));
	}
	
}