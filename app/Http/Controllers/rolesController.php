<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Privilege;
use App\Http\Controllers\Sentinel;
use App\Helpers\Helper;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Roles & Privileges';
        $data['permissions'] = Privilege::lists('permission', 'permission');
        $data['allPersmissions']  = Privilege::all();
        $data['roles']  = Role::all();
        // foreach ($data['roles'] as $role) {
        //     echo $role->permissions;
        // }
        return view('settings.roles.roles', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.roles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->assign_permission);

        //array to hold final permission values
        $array_of_permissions = Helper::prepPermissions($request->assign_permission, 'true');

        //create new role
        $role = \Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->role,
            'slug' => Helper::makeSlug($request->role),
        ]);

        //retreive id of last inserted role
        $role_id = $role->id;

        $role = \Sentinel::findRoleById($role_id);

        //assign permissions to role
        $role->permissions = $array_of_permissions;

        $role->save();

        return \Redirect::to('settings/roles');
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
        //
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
        //
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


    
    //get the permissions that have been assigned to a role
    public function rolePermissions(Request $request){

        $role_permissions = Helper::getRolePermissions($request->role_id);
        // dd($role_permissions);
        $options = array();
        foreach ($role_permissions as $role_permission) {
            // dd($role_permission);
            $options = $role_permissions;
        }
        
        // dd($options);
        return Response::json(['options' => $options, 'other' => 'something']);
    }
}
