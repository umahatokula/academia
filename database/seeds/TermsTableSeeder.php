<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('terms')->truncate();

        DB::table('terms')->insert(['term' => 1]);

        DB::table('terms')->insert(['term' => 2]);

        DB::table('terms')->insert(['term' => 3]);
    }
}
