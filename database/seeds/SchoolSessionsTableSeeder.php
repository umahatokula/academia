<?php

use Illuminate\Database\Seeder;

class SchoolSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('school_sessions')->truncate();

        // $session = [];
        // for ($i=intval(date('Y'))-10; $i < intval(date('Y'))+15 ; $i++) { 
        // 	$session = ($i.'-'.$i+1);
        //     DB::table('school_sessions')->insert(['session' => $session]);
        // }

    }
}
