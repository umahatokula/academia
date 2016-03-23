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

        $this->call(UserTableSeeder::class);
        $this->call('CountriesSeeder');
        $this->call('\GenderTableSeeder');
        $this->call('\AgeGroupTableSeeder');
        $this->call('\StateTableSeeder');
        $this->call('\LocalTableSeeder');
        $this->call('\UserTableSeeder');
        $this->call('\bloodGroupsTableSeeder');
        $this->call('\staffTableSeeder');
        $this->call('\staffTypeTableSeeder');
        $this->call('\StatusTableSeeder');
        $this->call('\religionTableSeeder');
        $this->call('\TermsTableSeeder');
        $this->call('\SchoolSessionsTableSeeder');
        $this->call('\bankTableSeeder');
        $this->call('\discountPoliciesTableSeeder');
        $this->call('\discountDurationsTableSeeder');
        $this->call('\chartOfAccountsTableSeeder');
        $this->call('\studentsTableSeeder');
        $this->call('\parentTableSeeder');
        $this->call('\staffTableSeeder');
        $this->call('\subjectsTableSeeder');
        $this->call('\classesTableSeeder');
        $this->call('\paymentTypesTableSeeder');
        $this->call('\schoolsTableSeeder');
        $this->call('\feeElementsTableSeeder');
        $this->command->info('Tables seeded!');

        Model::reguard();
    }
}
