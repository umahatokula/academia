<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Http\Requests\createClassRequest;
use \App\Http\Requests\updateClassRequest;
use App\Http\Controllers\Controller;
use DB;

use \App\StudentClass;
use \App\Staff;
use \App\Subject;

class classesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Class';
        $data['classes_menu'] = 1;
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
        $data['title'] = 'Create Class';
        $data['classes_menu'] = 1;
        $data['staffs'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->where('staff_type_id', 1)->lists('full_name', 'id')->prepend('Please Select');
        $data['subjects'] = Subject::lists('subject', 'id')->prepend('Please Select');
        $data['classes'] = studentClass::lists('name', 'id')->prepend('Please Select');
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
        // dd($request->all());
        // dd($request->subject_id);
        $class = new StudentClass;
        $class->name = $request->name;
        $class->staff_id = $request->staff_id;
        $class->max_students = $request->max_students;
        $class->promotion_class_id = $request->promotion_class_id;
        $class->save();

        for ($i=0; $i < count($request->subject_id) ; $i++) { 
            $record = \DB::table('class_subject')->where('class_id', $class->id)->where('subject_id', $request->subject_id[$i])->first();
            if (is_null($record)) {
                \DB::table('class_subject')->insert(
                    array('class_id' => $class->id, 'subject_id' => $request->subject_id[$i], 'staff_id' => $request->staff[$i])
                    );
            }
            
        }

        // DB::statement();

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
        $data['title'] = 'Edit Class';
        $data['classes_menu'] = 1;
        $data['staffs'] = Staff::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->where('staff_type_id', 1)->lists('full_name', 'id')->prepend('Please Select');
        $data['subjects'] = Subject::lists('subject', 'id')->prepend('Please Select');
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
        // dd($request->all());
        $this->validate($request, ['name' => 'required', 'max_students' => 'integer|required']);
        
        $class = StudentClass::find($id);
        $class->fill($request->except('subject_id', 'staff'))->save();

        $subject_ids = $request->subject_id;
        // dd($subject_ids);
        if ($subject_ids == null || !array_sum($subject_ids) > 0) {
            session()->flash('flash_message', 'Add at least one subject to this class. Changes NOT saved.');
            return redirect()->back();
        }
        $staffs = $request->staff;
        // dd($subject_ids);

        $old_subjects = DB::table('class_subject')->select('subject_id')->where('class_id', $id)->get();
        $old_subjects = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($old_subjects)), FALSE);
        // dd($old_subjects);
        $rejected = array_diff($old_subjects, $subject_ids);
        $rejected = array_values($rejected);
        // dd($rejected);

        for ($i=0; $i < count($rejected) ; $i++) {
            // dd($rejected[$i]);
            DB::table('class_subject')->where(['class_id' => $id, 'subject_id' => $rejected[$i] ])->delete();
        }



        for ($i=0; $i < count($request->subject_id) ; $i++) {
            $record = \DB::table('class_subject')->where('class_id', $class->id)->where('subject_id', $request->subject_id[$i])->first();
            if (is_null($record)) {
                \DB::table('class_subject')->insert(
                    array('class_id' => $class->id, 'subject_id' => $request->subject_id[$i], 'staff_id' => $request->staff[$i])
                    );
            }
            
        }

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

    public function numberIndex(){

    }
}
