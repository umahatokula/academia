<?php

use Illuminate\Database\Seeder;

use \App\School;

class schoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('schools')->truncate();

    	$school = new School;
        $school->name = '';
        $school->logo = '';
        $school->phone = '';
        $school->email = '';
        $school->swift_code = '';
        $school->line1 = '';
        $school->line2 = '';
        $school->line3 = '';
        $school->bank_id = 0;
        $school->account_name = '';
        $school->account_number = '';
        $school->promotion_avg = 0.00;
        $school->parent_discount = '';
        $school->staff_discount = '';
    	$school->save();
    }
}
