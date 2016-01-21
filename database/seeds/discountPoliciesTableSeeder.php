<?php

use Illuminate\Database\Seeder;

use App\DiscountPolicy;

class discountPoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_policies')->truncate();

        DiscountPolicy::create(['discount_name' => 'Parent']);

        DiscountPolicy::create(['discount_name' => 'Staff']);

        DiscountPolicy::create(['discount_name' => 'Scholarship']);
    }
}
