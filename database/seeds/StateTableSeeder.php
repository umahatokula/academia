<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	 	// DB::table('states')->delete();
	 	DB::table('states')->truncate();

		DB::statement("INSERT INTO `states` (`name`) VALUES ('Abia State'), ('Adamawa State'), ('Akwa Ibom State'), ('Anambra State'), ('Bauchi State'), ('Bayelsa State'), ('Benue State'), ('Borno State'), ('Cross River State'), ('Delta State'), ('Ebonyi State'), ('Edo State'), ('Ekiti State'), ('Enugu State'), ('FCT'), ('Gombe State'), ('Imo State'), ('Jigawa State'), ('Kaduna State'), ('Kano State'), ('Katsina State'), ('Kebbi State'), ('Kogi State'), ('Kwara State'), ('Lagos State'), ('Nasarawa State'), ('Niger State'), ('Ogun State'), ('Ondo State'), ('Osun State'), ('Oyo State'), ('Plateau State'), ('Rivers State'), ('Sokoto State'), ('Taraba State'), ('Yobe State'), ('Zamfara State')");
	}
}
