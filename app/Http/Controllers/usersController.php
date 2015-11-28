<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Staff;
use \App\Role;
use \App\User;
use \App\Helpers\Helper;

class usersController extends Controller
{

    // /**
    // *
    // */
    //   public function __construct(User $user)
    //   {
    //     $this->user = $user;
    //   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Manage Users';
        $data['staff'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id');
        $data['roles'] = Role::lists('name', 'id');
        $data['users'] = User::all();
        $data['permissions'] = [];
        return view('settings.users.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //get the persons details
        $staff = Staff::find($request->user);

        $data = ['email' => $staff->email];
        // var_dump($data);
        // dd($data);
            $rules = [
                'email'         => 'min:5|email|required|unique:users',
            ];
            $validator = \Validator::make($data,$rules);

            if($validator->passes()){
                // dd($staff->id);

                //array to hold final permission values
                $array_of_permissions = Helper::prepPermissions($request->exempt_permission, 'false');

                $credentials = [
                    'email'         => $staff->email,
                    'password'      => $request->password,
                    'permissions'   => $array_of_permissions,
                    'staff_id'     => $staff->id,
                    'first_name'    => $staff->fname,
                    'last_name'     => $staff->lname,
                ];

                //create new user
                $user = \Sentinel::create($credentials);

                //activate user
                $activation = \Activation::create($user);

                $activation_completed = \Activation::complete($user, $activation->code);

                //assign new user to role(s)
                $user = \Sentinel::findById($user->id);

                foreach ($request->assign_roles as $role_id) {

                    $role = \Sentinel::findRoleById($role_id);

                    $role->users()->attach($user);
                }

                return \Redirect::to('settings/users/create');

            }else{
                return \Redirect::back()->withInput()->withErrors($validator);
            }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['staff'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id');
        $data['roles'] = Role::lists('name', 'id');

        //get the id(s) of the roles of this user in an array
        $roles = array();
        foreach ($data['user']->roles as $value) {
            $roles[] = $value->id;
        }
        $data['user_roles'] = $roles;

        $data['permissions'] = [];
        return view('settings.users.modal_edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get user u ant to update
        $user = \Sentinel::findById($id);
         //get the persons details
        $staff = Staff::find($request->user);

        $data = $request->except('_token');

            $rules = [
                'password'         => 'min:4|required',
            ];

            $validator = \Validator::make($data,$rules);

            if($validator->passes()){

                //array to hold final permission values
                $array_of_permissions = Helper::prepPermissions($request->exempt_permission, 'false');

                $credentials = [
                    'email'         => $staff->email,
                    'password'      => $request->password,
                    'permissions'   => $array_of_permissions,
                    'staff_id'     => $staff->id,
                    'first_name'    => $staff->fname,
                    'last_name'     => $staff->lname,
                ];

        
                //update user
                $user = \Sentinel::update($user, $credentials);

                //get the id(s) of the current roles of this user in an array
                $current_roles = array();
                foreach ($user->roles as $value) {
                    $current_roles[] = $value->id;
                }

                //compute role(s) to add
                $add_roles = array_diff($request->assign_roles, $current_roles);

                //compute role(s) to delete
                $delete_roles = array_diff($current_roles, $request->assign_roles);

                //update user role(s)
                $user = \Sentinel::findById($user->id);

                //add ne role(s)
                foreach ($add_roles as $role_id) {

                        $role = \Sentinel::findRoleById($role_id);

                        $role->users()->attach($user);
                    
                }

                //delete role(s), if any
                foreach ($delete_roles as $role_id) {

                    \DB::table('role_users')->where('role_id', $role_id)->where('user_id', $user->id)->delete();
                    
                }

                return \Redirect::to('settings/users/create');

            }else{

                return \Redirect::back()->withInput()->withErrors($validator);

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
