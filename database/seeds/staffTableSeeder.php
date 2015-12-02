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
					'fname'         => 'Arome',
		            'lname'         => 'Tokula',
		            'email'         => 'arome_tokula@yahoo.com',
		            'phone'         => '08055271439',
		            'address'      	=> 'No 7 Canaan Str, GRA, Gboko, Benue State',
		            'gender_id'    	=> '1',
		            'staff_type_id' => '1',
		            'country_id' 	=> '1',
		            'state_id' 		=> '1',
		            'local_id' 		=> '1'
		        ));
    }
}
