<?php

use Illuminate\Database\Seeder;

use \App\BloodGroup;

class bloodGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_groups')->truncate();

		$blood_group_A = BloodGroup::create(array(
		            'blood_group'         => 'A'
		        ));

		$blood_group_B = BloodGroup::create(array(
		            'blood_group'         => 'B'
		        ));

		$blood_group_AB = BloodGroup::create(array(
		            'blood_group'         => 'AB'
		        ));

		$blood_group_O = BloodGroup::create(array(
		            'blood_group'         => 'O'
		        ));
    }
}
