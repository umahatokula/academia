<?php

use Illuminate\Database\Seeder;

use \App\Bank;

class bankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('banks')->truncate();

        Bank::create(['name' => 'Access Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Citibank Nigeria Limited',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Diamond Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Ecobank Nigeria Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Enterprise Bank',
        				'coa_id' => 0]);

        Bank::create(['name' => 'Fidelity Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'First Bank of Nigeria Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'First City Monument Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Guaranty Trust Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Heritage Banking Company Ltd',
        				'coa_id' => 0]);

        Bank::create(['name' => 'Key Stone Bank',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'MainStreet Bank',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Skye Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Stanbic IBTC Bank Ltd',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Standard Chartered Bank Nigeria Ltd 	',
        				'coa_id' => 0]);

        Bank::create(['name' => 'Sterling Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Union Bank of Nigeria Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'United Bank For Africa Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Unity Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Wema Bank Plc',
        				'coa_id' => 0]); 

        Bank::create(['name' => 'Zenith Bank Plc', 'coa_id' => 0]);  
    }
}
