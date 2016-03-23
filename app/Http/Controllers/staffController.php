<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Http\Requests\createStaffRequest;

use App\Staff;
use App\Gender;
use App\StaffType;
use App\Country;
use App\State;
use App\Local;

class staffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Staff Mgt';
        $data['staff_menu'] = 1;
        $data['staffs'] = Staff::all();
        return view('admin.staff.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Staff';
        $data['staff_menu'] = 1;
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['staff_types'] = StaffType::lists('staff_type', 'id')->prepend('Please Select');
        return view('admin.staff.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createStaffRequest $request)
    {
        $staff = Staff::create($request->except('picture'));

        if($request->picture->getClientOriginalExtension() == 'jpg'){

            $imageName = $staff->id.'.'.$request->picture->getClientOriginalExtension();

            $request->picture->move(base_path().'/public/assets/images/staff/', $imageName);

            session()->flash('flash_message', 'Staff successfully registered.');
            session()->flash('flash_message_important', true);

            return redirect('admin/staff');
        }

        session()->flash('flash_message', 'Only .jpg images are allowed.');

        return redirect('admin/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['staff'] = Staff::find($id);
        $data['staff_menu'] = 1;
        return view('admin.staff.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Staff';
        $data['staff'] = Staff::find($id);
        $data['staff_menu'] = 1;
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['staff_types'] = StaffType::lists('staff_type', 'id')->prepend('Please Select');
        return view('admin.staff.edit', $data);
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
        $staff = Staff::find($id);
        $staff->fill($request->all())->save();

        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->destroy();

        return $this->index();
    }
}
