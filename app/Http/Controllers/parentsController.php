<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\createParentRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\State;
use App\Gender;
use App\BloodGroup;
use App\Country;
use App\Student;
use App\Local;
use App\StudentParent;
use App\Religion;

class parentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Parents';
        $data['parents'] = StudentParent::all();
        return view('admin.parents.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Parent';
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['bloodGroups'] = BloodGroup::lists('blood_group', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['religions'] = Religion::lists('religion', 'id')->prepend('Please Select');
        return view('admin.parents.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createParentRequest $request)
    {
        $parent = new StudentParent;

        $parent->create($request->all());

        session()->flash('flash_message', 'Parent successfully registered.');
        session()->flash('flash_message_important', true);

        return redirect('admin/parents');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['parent'] = StudentParent::find($id);
        return view('admin.parents.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['parent'] = StudentParent::find($id);
        $data['title'] = 'Add Parent';
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['bloodGroups'] = BloodGroup::lists('blood_group', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['religions'] = Religion::lists('religion', 'id')->prepend('Please Select');
        return view('admin.parents.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(createParentRequest $request, $id)
    {
        $parent = StudentParent::find($id);
        $parent->fill($request->all())->save();

        return redirect('admin/parents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parent = StudentParent::find($id);
        $parent->delete();

        return redirect('admin/parents');
    }
}
