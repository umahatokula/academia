<?php

use Illuminate\Database\Seeder;

use App\StaffType;

class staffTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_types')->truncate();

		$type_1 = StaffType::create(array(
					'staff_type' 	=> 'Academic',
		            'status_id'    	=> 1
		        ));

		$type_2 = StaffType::create(array(
					'staff_type' 	=> 'Non Academic',
		            'status_id'    	=> 1
		        ));
    }
}
