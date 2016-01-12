<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\Http\Requests\createStudentRequest;

use App\User;
use App\State;
use App\Gender;
use App\BloodGroup;
use App\Country;
use App\Student;
use App\Local;
use App\StudentParent;
use App\StudentClass;
use App\Religion;

class studentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Students';
        $data['students_menu'] = 1;
        $data['students'] = Student::all();
        return view('admin.students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Students';
        $data['students_menu'] = 1;
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['bloodGroups'] = BloodGroup::lists('blood_group', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['parents'] = StudentParent::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id')->prepend('Please Select');
        $data['classes'] = StudentClass::lists('name', 'id')->prepend('Please Select');
        $data['religions'] = Religion::lists('religion', 'id')->prepend('Please Select');
        return view('admin.students.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createStudentRequest $request, Student $student)
    {

        if($request->picture->getClientOriginalExtension() == 'jpg'){

            $student = $student->create($request->except('picture'));

            $imageName = $student->id.'.'.$request->picture->getClientOriginalExtension();

            $request->picture->move(base_path().'/public/assets/images/students/', $imageName);

            session()->flash('flash_message', 'Student successfully registered.');
            session()->flash('flash_message_important', true);

            return redirect('admin/students');
        }

        session()->flash('flash_message', 'Only .jpg images are allowed.');

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['student'] = Student::find($id);
        $data['students_menu'] = 1;
        $data['title'] = $data['student']->fname;
        return view('admin.students.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['student'] = Student::find($id);

        $data['title'] = 'Edit '.$data['student']->fname;
        $data['students_menu'] = 1;
        $data['gender'] = Gender::lists('gender', 'id')->prepend('Please Select');
        $data['bloodGroups'] = BloodGroup::lists('blood_group', 'id')->prepend('Please Select');
        $data['locals'] = Local::lists('local_name', 'id')->prepend('Please Select');
        $data['states'] = State::lists('name', 'id')->prepend('Please Select');
        $data['countries'] = Country::lists('name', 'id')->prepend('Please Select');
        $data['parents'] = StudentParent::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id')->prepend('Please Select');
        $data['classes'] = StudentClass::lists('name', 'id')->prepend('Please Select');
        $data['religions'] = Religion::lists('religion', 'id')->prepend('Please Select');

        return view('admin.students.edit', $data);
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
        $student = Student::find($id);
        $student->fill($request->all())->save();
        return \Redirect::to('admin/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->destroy();
        return \Redirect::to('admin/students');
    }
}
