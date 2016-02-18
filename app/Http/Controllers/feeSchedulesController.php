<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


use App\FeeSchedule;
use App\studentClass;
use App\FeeElement;
use App\Student;

class feeSchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Fee Schedule';
        $data['fee_schedules_menu'] = 1;
        // $data['fee_schedules'] = FeeSchedule::all();
        $data['fee_schedules'] = FeeSchedule::groupBy('fee_schedule_code')->get();
        // dd($data['fee_schedules']);

        return view('billing.fee_schedules.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Fee Schedule';
        $data['fee_schedules_menu'] = 1;

        //create array to hole school session starting 10 yrs from current date
        $sessions = ['Select Session'];
        for ($i=intval(date('Y'))-10; $i < intval(date('Y'))+15 ; $i++) { 
            $session = $i.'-'.($i+1);
            $sessions[$session] = $session;
        }

        $data['sessions'] = $sessions;

        $data['terms'] = ['Select Term', 1, 2,3];

        $data['classes'] = studentClass::lists('name', 'id')->prepend('Select Class');

        $data['fee_elements'] = FeeElement::where('status_id', 1)->get();


        return view('billing.fee_schedules.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //ensure a class as selected
        if (0 == $request->class_id) {
            session()->flash('flash_message', 'Select Class');
            return \Redirect::back()->withInput();
        }
        //ensure a session as selected
        if (0 == $request->session) {
            session()->flash('flash_message', 'Select Session');
            return \Redirect::back()->withInput();
        }
        //ensure a term as selected
        if (0 == $request->term_id) {
            session()->flash('flash_message', 'Select Term');
            return \Redirect::back()->withInput();
        }
        //ensure at least one element was selected
        if (null == $request->element_id || null == $request->amount) {
            session()->flash('flash_message', 'Select fee elements');
            return \Redirect::back()->withInput();
        }
        // {class_id}{session}{term_id}
        $fee_schedule_code = strval($request->class_id).($request->session).strval($request->term_id);

        for ($i=0; $i < count($request->element_id); $i++) { 

            try{
                DB::table('fee_schedules')->insert([
                'fee_schedule_code'     => $fee_schedule_code,
                'fee_element_id'        => $request->element_id[$i],
                'amount'                => $request->amount[$i],
                'session'               => $request->session,
                'term_id'               => $request->term_id,
                'class_id'              => $request->class_id
                ]);
            }catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    session()->flash('flash_message', 'One or more elements chosen already exist.');
                    return \Redirect::back()->withInput($request->except('element_id', 'amount'));
                }
            }
        }

        return redirect('billing/fee_schedules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fee_schedule_code)
    {
        $data['title'] = 'Fee Schedule';
        $data['fee_schedules_menu'] = 1;
        $data['fee_schedules'] = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->get();

        return view('billing.fee_schedules.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_schedule_code)
    {
        $data['title'] = 'Fee Schedule';
        $data['fee_schedules_menu'] = 1;
        $data['fee_schedules'] = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->first();
        $data['fee_elements'] = FeeElement::where('status_id', 1)->get();
        $data['current_elements'] = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->lists('amount', 'fee_element_id')->toArray();
        return view('billing.fee_schedules.edit', $data);
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
        //ensuure at least one element and its corresponding amount was chosen
        if (null == $request->element_id || null == $request->amount) {
            session()->flash('flash_message', 'Select fee elements');
            return \Redirect::back()->withInput();
        }

        $merged = array_combine($request->element_id, $request->amount);
        // dd($merged);

        $current_elements = FeeSchedule::where('fee_schedule_code', $request->fee_schedule_code)->lists('fee_element_id')->toArray();
        // $current_elements = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($current_elements)), FALSE);
        // dd(array_flip($current_elements));

        $elements_to_remove = array_flip(array_diff_key(array_flip($current_elements), $merged));
        $elements_to_add = array_flip(array_diff_key($merged, array_flip($current_elements)));
        $elements_to_update = (array_diff_key($merged, array_flip($elements_to_add)));
        // dd($elements_to_update);

        //elements to delete from fee schedule
        if(!empty($elements_to_remove)){
            foreach ($elements_to_remove as $element_id) {

                try{
                    DB::table('fee_schedules')->where(['fee_schedule_code' => $request->fee_schedule_code, 'fee_element_id' => $element_id ])->delete();
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        session()->flash('flash_message', 'One or more elements chosen already exist.');
                        return \Redirect::back()->withInput($request->except('element_id', 'amount'));
                    }
                }
            }
        }


        //elements to update from fee schedule
        if (!empty($elements_to_update)) {
            foreach ($elements_to_update as $element_id => $element_amount) {
                // dd($element_amount);

                try{
                    DB::table('fee_schedules')
                    ->where(['fee_schedule_code' => $request->fee_schedule_code, 'fee_element_id' => $element_id ])
                    ->update(['amount' => $element_amount]);

                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        session()->flash('flash_message', 'One or more elements chosen already exist.');
                        return \Redirect::back()->withInput($request->except('element_id', 'amount'));
                    }
                }
            }
        }


        //elements to add from fee schedule
        if (!empty($elements_to_add)) {
            foreach ($elements_to_add as $element_amount => $element_id) {

                try{
                    DB::table('fee_schedules')->insert([
                    'fee_schedule_code'     => $request->fee_schedule_code,
                    'fee_element_id'        => $element_id,
                    'amount'                => $element_amount,
                    'session'               => $request->session,
                    'term_id'               => $request->term_id,
                    'class_id'              => $request->class_id
                    ]);
                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        session()->flash('flash_message', 'One or more elements chosen already exist.');
                        return \Redirect::back()->withInput($request->except('element_id', 'amount'));
                    }
                }
            }
        }

        return \Redirect::back();
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $fee_schedule = FeeSchedule::find($id);
        $fee_schedule->status_id = 1;
        $fee_schedule->save();

        return redirect('billing/fee_schedule');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $fee_schedule = FeeSchedule::find($id);
        $fee_schedule->status_id = 2;
        $fee_schedule->save();

        return redirect('billing/fee_schedule');
    }


    public function billClass($fee_schedule_code){
        $class_id = FeeSchedule::select('class_id')->where('fee_schedule_code', $fee_schedule_code)->first();
        $students = Student::where('class_id', $class_id->class_id)->get();

        foreach ($students as $student) {
            echo ($student->fname);
        }
    }
}
