<?php

use Illuminate\Database\Seeder;

use \App\PaymentType;

class paymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([ 
        	'payment_type' 	=> 'Invoice Payment',
        	'status_id' 	=> 1]);

        PaymentType::create([ 
        	'payment_type' 	=> 'Others',
        	'status_id' 	=> 1]);
    }
}
