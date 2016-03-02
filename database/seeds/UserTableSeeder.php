<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        //truncate roles
        DB::table('roles')->truncate();

        //truncate role_users
        DB::table('role_users')->truncate();

        
        $credentials = [
                    'email'         => 'umahatokula@ovalsofttechnologies.com',
                    'password'      => 'come',
                    'first_name'    => 'Umaha',
                    'last_name'     => 'Tokula'
                ];

                //create new user
        $user = \Sentinel::create($credentials);

        $activation = \Activation::create($user);

        $activation_completed = \Activation::complete($user, $activation->code);


        //create coder role
        $coder = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Coder',
            'slug' => 'coder',
        ]);

        //assign user this role
        $coder->users()->attach($user);


        //create principal role
        $principal = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Principal',
            'slug' => 'principal',
        ]);

        //assign user this role
        $principal->users()->attach($user);

        //create head teacher role
        $head_teacher = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Class Teacher',
            'slug' => 'head_teacher',
        ]);

        //assign user this role
        $head_teacher->users()->attach($user);


        //create billing officer role
        $billing_officer = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Billing Officer',
            'slug' => 'billing_officer',
        ]);

        //assign user this role
        $billing_officer->users()->attach($user);


        //create admin dept officer role
        $admin_dept_officer = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admin Dept Officer',
            'slug' => 'admin_dept_officer',
        ]);

        //assign user this role
        $admin_dept_officer->users()->attach($user);


        //create accounts officer role
        $accounts_officer = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Accounts Officer',
            'slug' => 'accounts_officer',
        ]);

        //assign user this role
        $accounts_officer->users()->attach($user);
    }
}
