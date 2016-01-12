<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Staff;
use \App\Student;
use \App\studentClass;

class resultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Result Sheet';
        $data['results_menu'] = 1;
        $staff = Staff::find(\Session::get('user')->staff_id);
        $classes = array('Please select a class');
        foreach ($staff->classes as  $class) {
            $classes[$class->id] = $class->name;
        }
        $data['classes'] = $classes;
        return view('academics.results.index', $data);
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
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

    public function fetchSheet(Request $request){

        $data['title'] = 'Scoresheet';
        $data['results_menu'] = 1;
        // dd($request);
        if($request->class == 0){
            session()->flash('flash_message', 'Welcome');
            // session()->flash('flash_message_important', true);
            return \Redirect::to('academics/results');
        }

        $data['class'] = studentClass::where(['id' => $request->class])->first();
        $data['subjects'] = \DB::table('class_subject')->where(['class_id'=> $request->class])->get();
        $data['students'] = Student::where(['class_id' => $request->class])->get();
        return view('academics.results.edit', $data);
    }


    public function storeStudentResult(array $Array){
    $Output = '<ul>';
    foreach($Array as $Key => $Value){
        $Output .= "<li><strong>{$Key}: </strong>";
        if(is_array($Value)){
            $Output .= makeNestedList($Value);
        }else{
            $Output .= $Value;
        }
        $Output .= '</li>';
    }
    $Output .= '</ul>';
    return $Output;
}
}
