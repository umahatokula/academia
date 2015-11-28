<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Http\Requests\createClassRequest;
use App\Http\Controllers\Controller;

use \App\StudentClass;
use \App\Staff;

class classesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['classes'] = StudentClass::all();
        return view('settings.class.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['staffs'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->where('staff_type_id', 1)->lists('full_name', 'id');
        return view('settings.class.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createClassRequest $request)
    {

        $class = new StudentClass;
        $class->create($request->all());

        session()->flash('flash_message', 'Class successfully created.');
        session()->flash('flash_message_important', true);

        return redirect('settings/classes');
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
        $data['class'] = StudentClass::find($id);
        $data['staffs'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->where('staff_type_id', 1)->lists('full_name', 'id');
        return view('settings.class.edit', $data);
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
        $this->validate($request, ['name' => 'required|unique:classes,name', 'max_students' => 'integer|required']);
        $class = StudentClass::find($id);
        $class->fill($request->all())->save();

        session()->flash('flash_message', 'Class successfully updated');
        session()->flash('flash_message_important', true);
        return redirect('settings/classes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentClass = StudentClass::find($id);
        $studentClass->delete();
    }
}
