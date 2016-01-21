<?php

use Illuminate\Database\Seeder;

use App\DiscountDuration;

class discountDurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount_durations')->truncate();

        DiscountDuration::create(['duration' => 'Term']);
        DiscountDuration::create(['duration' => 'Session']);
        DiscountDuration::create(['duration' => 'Always']);
    }
}
