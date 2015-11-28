<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Religion;

class religionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->truncate();

		$Christianity = Religion::create(array(
		            'religion'         => 'Christianity'
		        ));

		$Islam = Religion::create(array(
		            'religion'         => 'Islam'
		        ));

		$Judaism  = Religion::create(array(
		            'religion'         => 'Judaism '
		        ));

		$Others = Religion::create(array(
		            'religion'         => 'Others'
		        ));
    }
}
