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

		// User::create(array(
		//             'email'         => 'arome_tokula@yahoo.com',
		//             'password'         => 'come',
		//             'first_name'         => 'Arome',
		//             'last_name'         => 'Tokula',
		//             'staff_id'         => '1'
		//         ));

        $credentials = [
                    'email'         => 'arome_tokula@yahoo.com',
                    'password'      => 'come',
                    'first_name'    => 'Arome',
                    'last_name'     => 'Tokula',
                    'staff_id'      => 1,
                ];

                //create new user
        $user = \Sentinel::create($credentials);

        $activation = \Activation::create($user);

        $activation_completed = \Activation::complete($user, $activation->code);


        //create role
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Administrator',
            'slug' => 'super_administrator',
        ]);

        //assign user this role
        $role->users()->attach($user);
    }
}
