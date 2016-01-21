<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            // $this->call(UserTableSeeder::class);
            //$this->call('CountriesSeeder');
            // $this->call('\GenderTableSeeder');
            // $this->call('\AgeGroupTableSeeder');
            // $this->call('\StateTableSeeder');
            // $this->call('\LocalTableSeeder');
            // $this->call('\UserTableSeeder');
            // $this->call('\bloodGroupsTableSeeder');
            // $this->call('\staffTableSeeder');
            // $this->call('\staffTypeTableSeeder');
            // $this->call('\StatusTableSeeder');
            // $this->call('\religionTableSeeder');
            // $this->call('\TermsTableSeeder');
            // $this->call('\SchoolSessionsTableSeeder');
            // $this->call('\bankTableSeeder');
             $this->call('\discountPoliciesTableSeeder');
             $this->call('\discountDurationsTableSeeder');
            $this->command->info('Tables seeded!');

        Model::reguard();
    }
}
