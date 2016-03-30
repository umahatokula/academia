<?php

use Illuminate\Database\Seeder;

use App\TransactionMode;


class TransactionModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('transaction_modes')->truncate();

		$cash = TransactionMode::create(array(
		            'transaction_mode'         => 'Cash',
		            'short_code' => 'CASH'
		        ));

		$cheque = TransactionMode::create(array(
		            'transaction_mode'         => 'Cheque',
		            'short_code' => 'CHEQ'
		        ));

		$draft = TransactionMode::create(array(
		            'transaction_mode'         => 'Draft',
		            'short_code' => 'DRFT'
		        ));

		$pos = TransactionMode::create(array(
		            'transaction_mode'         => 'POS',
		            'short_code' => 'POS'
		        ));

		$online = TransactionMode::create(array(
		            'transaction_mode'         => 'Online',
		            'short_code' => 'ONLN'
		        ));
    }
}
