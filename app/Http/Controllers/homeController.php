<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Helpers\Helper;

use \App\Staff;
use \App\Student;
use \App\studentClass;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Home';
        $data['home'] = 1;
        $staff = Staff::find(\Session::get('user')->staff_id);
        // dd($staff);
        if($staff) {
            $classes = array('Please select a class');
            foreach ($staff->classes as  $class) {
                $classes[$class->id] = $class->name;
            }
            $data['classes'] = $classes;
        }
        
        if(session('user')->inRole('coder') || session('user')->inRole('principal')){

            return view('dashboard', $data);

        }elseif(session('user')->inRole('head_teacher')){

            return view('dashboard_head_teacher', $data);

        }elseif(session('user')->inRole('billing_officer')){

            // return view('dashboard_billing_officer', $data);
            return redirect()->route('billing.fee_schedules.index');

        }elseif(session('user')->inRole('admin_dept_officer')){

            return view('dashboard_head_teacher', $data);

        }else{
            
            return view('unauthorized', $data);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function error(){
        return view('error');
    }
}
