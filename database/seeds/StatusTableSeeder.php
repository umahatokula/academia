<?php

use Illuminate\Database\Seeder;

use \App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->truncate();

		Status::create(array(
		            'status'         => 'active'
		        ));

		Status::create(array(
		            'status'         => 'inactive'
		        ));

		Status::create(array(
		            'status'         => 'approved'
		        ));

		Status::create(array(
		            'status'         => 'unprocessed'
		        ));

		Status::create(array(
		            'status'         => 'declined'
		        ));

		Status::create(array(
		            'status'         => 'paid'
		        ));

		Status::create(array(
		            'status'         => 'unpaid'
		        ));
    }
}
