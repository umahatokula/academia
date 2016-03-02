<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Helpers\Helper;

use \App\Staff;
use \App\Student;
use \App\studentClass;
use \App\Subject;
use \App\School;

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
        if(\Sentinel::getUser()->inRole('principal') OR \Sentinel::getUser()->inRole('coder')) {
            $data['classes'] = studentClass::lists('name', 'id')->prepend('Select a class');
        }else{
            $classes = array('Please select a class');
            foreach ($staff->classes as  $class) {
                $classes[$class->id] = $class->name;
            }
            $data['classes'] = $classes;

        }
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
    public function update(Request $request, $id) {
        // dd($request);
        $results = $request->result;
        $class_id = $request->class_id;

        $table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');
        
        foreach ($results as $student_id => $subjects) {
            // dd($subject_id);
            foreach ($subjects as $subject_id => $scores) {
                    // dd($scores);
                $scores = array_slice($scores, -4, 4);
                    // dd($scores);
                $subject_total = array_sum($scores);

                //get student's grade for this subject
                $grade = Helper::get_grade($subject_total);
                try{
                    \DB::table($table)
                    ->where([
                        'class_id'      => $request->class_id,
                        'student_id'    => $student_id,
                        'subject_id'    => $subject_id])
                    ->update([
                        'ca1'           => $scores[0],
                        'ca2'           => $scores[1],
                        'ca3'           => $scores[2],
                        'exam'          => $scores[3],
                        'subject_total' => $subject_total,
                        'grade'         => $grade
                        ]);


                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1050){
                        session()->flash('flash_message', 'There was a problem updating records.');
                        return \Redirect::back()->withInput();
                    }
                }

            }
        }

        //get all subjects assigned to this class
        $class_subjects = studentClass::find($class_id)->subjects;
        
        //get ids of all subjects assigned to this class
        foreach ($class_subjects as $subject) {

            //calculate and enter subject position for each student
            $subject_scores = \DB::table($table)->where(['class_id' => $class_id, 'subject_id' => $subject->id])->lists('subject_total', 'student_id');
            $subject_position = Helper::calculate_position($subject_scores);

            foreach ($subject_position as $student_id => $position) {
                \DB::table($table)
                ->where([
                    'class_id'      => $class_id,
                    'student_id'    => $student_id,
                    'subject_id'    => $subject->id])
                ->update([
                    'subject_position' => $position
                    ]);
            }
        }

        return redirect()->route('academics.results.index');
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

    public function fetchSheet( Request $request){
        // dd($request->class);
        $class_id = $request->class;

        $data['title'] = 'Scoresheet';
        $data['results_menu'] = 1;

        //data for selecting class
        $staff = Staff::find(\Session::get('user')->staff_id);
        $classes = array('Please select a class');
        foreach ($staff->classes as  $class) {
            $classes[$class->id] = $class->name;
        }
        $data['classes'] = $classes;


        // dd($request);
        if($class_id == 0){
            session()->flash('flash_message', 'Select a class');
            // session()->flash('flash_message_important', true);
            return \Redirect::to('academics/results');
        }

        $class = studentClass::where(['id' => $class_id])->first();
        $subjects = \DB::table('class_subject')->where(['class_id'=> $class_id])->get();
        $students = Student::where(['class_id' => $class_id])->get();


        //add students to class results table with initial values of zero
        foreach ($students as $student) {
            foreach ($class->subjects as $subject) {

                $table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');

                $positions_table = 'class_positions_'.\Session::get('current_session').'_'.\Session::get('current_term');

                $subject_exemption_table = 'subject_ex_'.\Session::get('current_session').'_'.\Session::get('current_term');

                //initialize class results table
                try{
                    \DB::table($table)->insert([
                        'class_id'      => $class->id,
                        'student_id'    => $student->id,
                        'subject_id'    => $subject->id,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s'),
                        ]);

                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    // if($errorCode == 1062){
                    //     session()->flash('flash_message', 'Session and Term variables have alreaddy been created.');
                    //     return \Redirect::back()->withInput($request->except('element_id', 'amount'));
                    // }
                }


                //initialize class positions table
                try{
                    \DB::table($positions_table)
                    ->insert([
                        'class_id'      => $class->id,
                        'student_id'    => $student->id
                        ]);
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    // if($errorCode == 1050){
                    //     session()->flash('flash_message', 'Result table for chosen session and term already exists.');
                    //     return \Redirect::back()->withInput();
                    // }
                }


                //initialize subject exemption table
                try{
                    \DB::table($subject_exemption_table)
                    ->insert([
                        'class_id'      => $class->id,
                        'student_id'    => $student->id,
                        'subject_id'    => $subject->id,
                        ]);
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1050){
                        session()->flash('flash_message', 'Result table for chosen session and term already exists.');
                        return \Redirect::back()->withInput();
                    }
                }
            }
        }

        $data['class'] = $class;
        $data['subjects'] = $subjects;
        $data['students'] = $students;
        $data['selected_class'] = 1;

        return view('academics.results.index', $data);
    }


    /**
     * save students' results in db
     * @param  array  $Array multi-dimensional array holding students' results
     * @return [type]        [description]
     */
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


    /**
     * compute averages and positions for students in class
     * @param  int $class_id class id
     * @return route    redirect to route
     */
    public function compute_result($class_id) {

        //get all students in this class
        $students = Student::where('class_id', $class_id)->get();

        //get the number of subjects for this class
        $number_of_subjects = count(studentClass::find($class_id)->subjects);

        $result_table = 'class_results_'.\Session::get('current_session').'_'.\Session::get('current_term');

        $positions_table = 'class_positions_'.\Session::get('current_session').'_'.\Session::get('current_term');

        //array to hold all students total scores
        $results = [];

        foreach ($students as $student) {

            $total_score = 0;

            $offered_subjects = Helper::get_offered_subjects($class_id, $student->id);

            foreach ($offered_subjects as $subject_id) {
                $subject = \DB::table($result_table)
                ->where(['class_id' => $class_id, 'student_id' => $student->id, 'subject_id' => $subject_id])
                ->first();

                $total_score += $subject->subject_total;
            }

            $results[$student->id] = $total_score;

        }

        $positions = Helper::calculate_position($results);


        foreach ($positions as $student_id => $position) {

            $total_score = 0;

            $offered_subjects = Helper::get_offered_subjects($class_id, $student_id);

            foreach ($offered_subjects as $subject_id) {
                $subject = \DB::table($result_table)
                ->where(['class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject_id])
                ->first();

                $total_score += $subject->subject_total;
            }

            $average = floatVal($total_score)/ floatVal(count($offered_subjects));

            try{
                \DB::table($positions_table)
                ->where(['class_id' => $class_id, 'student_id' => $student_id])
                ->update([
                    'total'         => $total_score,
                    'average'       => $average,
                    'position'      => $position,
                    'status_id'     => 6
                    ]);
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                    // if($errorCode == 1050){
                    //     session()->flash('flash_message', 'Result table for chosen session and term already exists.');
                    //     return \Redirect::back()->withInput();
                    // }
            }

        }

        return redirect()->route('results.result_sheet', array($class_id));
    }


    public function show_result_sheet($class_id) {
        $data['title'] = 'Resultsheet';
        $data['results_menu'] = 1;
        // dd($request);
        if($class_id == 0){
            session()->flash('flash_message', 'Welcome');
            // session()->flash('flash_message_important', true);
            return \Redirect::to('academics/results');
        }

        $class = studentClass::where(['id' => $class_id])->first();
        $subjects = \DB::table('class_subject')->where(['class_id'=> $class_id])->get();
        $students = Student::where(['class_id' => $class_id])->get();

        $data['class'] = $class;
        $data['subjects'] = $subjects;
        $data['students'] = $students;

        return view('academics.results.result_sheet', $data);
    }


    public function student_subject_exemption($class_id) {
        $data['title'] = 'Subject Exemption';
        $data['results_menu'] = 1;
        // dd($request);
        if($class_id == 0){
            session()->flash('flash_message', 'Welcome');
            // session()->flash('flash_message_important', true);
            return \Redirect::to('academics/results');
        }

        $class = studentClass::where(['id' => $class_id])->first();
        $subjects = \DB::table('class_subject')->where(['class_id'=> $class_id])->get();
        $students = Student::where(['class_id' => $class_id])->get();

        $data['class'] = $class;
        $data['subjects'] = $subjects;
        $data['students'] = $students;

        return view('academics.results.student_subject_exemption', $data);

    }


    /**
     * exempt students from taking some subjects
     * @param  Request $request [description]
     * @return url           Redirect to a url
     */
    public function store_student_subject_exemption( Request $request) {

        // dd($request->to_exempt);

        $class_id = $request->class_id;
        $students_in_class = $request->to_exempt;

        //get table name based on current session and term
        $subject_exemption_table = 'subject_ex_'.\Session::get('current_session').'_'.\Session::get('current_term');

        //get all subjects assigned to this class
        $class_subjects = studentClass::find($class_id)->subjects;
        
        $all_subjects = [];

        //get ids of all subjects assigned to this class
        foreach ($class_subjects as $subject) {
            $all_subjects[] = $subject->id;
        }

        $not_to_exempt = [];

        //iterate for each student and register subjects eing taken
        foreach ($students_in_class as $student_id => $subjects) {

            //get subjects that SHOULD NOT be exempted
            foreach ($subjects as $key => $subject) {

                $not_to_exempt[] = $subject;

            }

            // get subjects that SHOULD be exempted
            $exempt = array_diff($all_subjects, $not_to_exempt);

            //update student record with subjects that SHOULD be exempted
            foreach ($exempt as $subject_id) {

                try{
                    \DB::table($subject_exemption_table)
                    ->where(['class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject_id])
                    ->update([
                        'state'         => 0,
                        ]);
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                }
            }

            //update student record with subjects that SHOULD NOT be exempted
            foreach ($not_to_exempt as $subject_id) {
                try{
                    \DB::table($subject_exemption_table)
                    ->where(['class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject_id])
                    ->update([
                        'state'         => 1,
                        ]);
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                }
            }

            //reset array
            $not_to_exempt = [];
        }

        return redirect()->route('results.student_subject_exemption', array($class_id));

    }


    public function report_sheet($student_id, $class_id) {
        $data['title'] = 'Report Sheet';
        $data['results_menu'] = 1;

        $data['school'] = School::find(1)->first();

        $data['offered_subjects'] = \App\Helpers\Helper::get_offered_subjects($class_id, $student_id);

        $data['class'] = studentClass::find($class_id);

        $data['student'] = Student::find($student_id);

        $data['students'] = Student::where(['class_id' => $class_id])->get();

        $data['admission_number'] = str_pad(str_replace('-', '/', \Session::get('current_session')).'/'.$student_id, 4, '0', STR_PAD_LEFT);

        $positions_table = 'class_positions_'.\Session::get('current_session').'_'.\Session::get('current_term');
        $data['student_position'] = \DB::table($positions_table)->where(['class_id' => $class_id, 'student_id' => $student_id])->first();

        return view('academics.results.report_sheet', $data);
    }


    public function promote($class_id) {

        $table = 'class_positions_'.\Session::get('current_session').'_'.\Session::get('current_term');

        $promotion_class_id = studentClass::where('id', $class_id)->first()->promotion_class_id;

        $pass_avg = 50.00;

        $students = Student::where('class_id', $class_id)->get();

        foreach ($students as $student) {

            $student_avg = \DB::table($table)->where(['student_id' => $student->id, 'class_id' => $class_id])->first()->average;

            if($student_avg >= $pass_avg){
                $std = new Student;
                $std->class_id = $promotion_class_id;
                $std->save();
            }
        }
    }

}
