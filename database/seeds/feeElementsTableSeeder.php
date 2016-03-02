<?php

use Illuminate\Database\Seeder;

use \App\FeeElement;
use \App\ChartOfAccount;

class feeElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fee_elements')->truncate();

		$tuition = FeeElement::create(array(
		            'code'         => 'TUI',
		            'name'         => 'Tuition',
		            'description'  => 'Payment for Tuition',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Tuition',
                                'account_code'      => $tuition->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$medical = FeeElement::create(array(
		            'code'         => 'MED',
		            'name'         => 'Medical',
		            'description'  => 'Payment for medical expenses',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Medical',
                                'account_code'      => $medical->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);



		$food = FeeElement::create(array(
		            'code'         => 'Food',
		            'name'         => 'Food',
		            'description'  => 'Payment for all meals in school',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Food',
                                'account_code'      => $food->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$devLev = FeeElement::create(array(
		            'code'         => 'DevLEV',
		            'name'         => 'Development Levy',
		            'description'  => 'Payment for all school development projects',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Development Levy',
                                'account_code'      => $devLev->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$sch_bus = FeeElement::create(array(
		            'code'         => 'SchBUS',
		            'name'         => 'School Bus',
		            'description'  => 'Payment for us of the School Bus',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'School Bus',
                                'account_code'      => $sch_bus->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$comp_ict = FeeElement::create(array(
		            'code'         => 'CompICT',
		            'name'         => 'Computer & ICT',
		            'description'  => 'Payment for use of all Computers and ICT infrastructure',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Computer & ICT',
                                'account_code'      => $comp_ict->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$pta = FeeElement::create(array(
		            'code'         => 'PTA',
		            'name'         => 'PTA',
		            'description'  => 'Payment for PTA',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'PTA',
                                'account_code'      => $pta->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);




		$excursion = FeeElement::create(array(
		            'code'         => 'ECURSION',
		            'name'         => 'Excursion',
		            'description'  => 'Payment for Excursion',
		            'status_id'    => 1,
		        ));

		//get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => 'Excursion',
                                'account_code'      => $excursion->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);



    }
}
