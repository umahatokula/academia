<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\FeeSchedule;

use \App\studentClass;
use \App\Student;

class paymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Payments';
        $data['payments_menu'] = 1;

        $data['classes'] = studentClass::lists('name', 'id')->prepend('Please Select');
        $data['students'] = Student::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id')->prepend('Please Select');

        $data['student_info'] = [];
        $data['student_invoice'] = [];
        $data['student_fee_elements'] = [];
        $data['exempted_elements'] = [];

        return view('payments.payments', $data);
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

    public function pay_invoice(Request $request) {
        // dd($request->all());
        $class_id = $request->class_id;
        $student_id = $request->student_id;
        $fee_schedule_code = strval($class_id).(session()->get('current_session')).strval(session()->get('current_term'));

        $session = session()->get('current_session');
        $term = session()->get('current_term');

        //current session invoice table
        $table = 'invoices_'.$session.'_'.$term;

        //get fee schedule elements
        $data['student_fee_elements'] = FeeSchedule::where(['fee_schedule_code' => $fee_schedule_code])->get();

        //get student invoice including exmepted fee elements
        $data['student_invoice'] = \DB::table($table)->where(['student_id' => $student_id, 'fee_schedule_code' => $fee_schedule_code])->first();
        $data['exempted_elements'] = json_decode($data['student_invoice']->exempted_fee_elements);
        if ($data['exempted_elements'] == null) {
            $data['exempted_elements'] = [];

        }


        $data['student_info'] = Student::find($student_id);
        $data['classes'] = studentClass::lists('name', 'id')->prepend('Please Select');
        $data['students'] = Student::select(\DB::raw('concat (fname," ",lname) as full_name, id'))->lists('full_name', 'id')->prepend('Please Select');

        return view('payments.payments', $data);
    }
}
