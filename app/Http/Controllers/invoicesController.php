<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FeeSchedule;
use App\Student;
use App\School;
use App\Staff;
use App\StudentClass;
use App\Invoice;
use App\FeeElement;
use App\Helpers\Helper;

class invoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Invoices';
        $data['invoice_menu'] = 1;

        $staff = Staff::find(\Session::get('user')->staff_id);
        foreach ($staff->classes as  $class) {
            $classes[$class->id] = $class->name;
        }

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

        return view('billing.invoices.class_invoices', $data);
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
    public function student_invoice($student_id, $fee_schedule_code){

        $data['fee_elements'] = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->get();
        $data['fee_schedule'] = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->first();
        $data['invoice'] = Invoice::where(['student_id' => $student_id, 'fee_schedule_code' => $fee_schedule_code])->first();
        // dd($data['fee_schedule']);
        $data['student'] = Student::findOrFail($student_id);
        $data['school'] = School::findOrFail(1);

        return view('billing.invoices.invoice', $data);    }

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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bill_class($fee_schedule_code){
        // dd($fee_schedule_code);
        $fee_schedule = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->first();
        $amount = FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->sum('amount');
        $students = Student::where('class_id', $fee_schedule->class_id)->get();

        foreach ($students as $student) {
            $discount = Helper::discountEngine($student->id);
            $total = $amount - $discount;

            try{
                Invoice::create([   'student_id' => $student->id,
                                    'fee_schedule_code' => $fee_schedule_code,
                                    'invoice_number' => str_replace('-', '', $fee_schedule_code).str_pad($student->id, 3, '0', STR_PAD_LEFT),
                                    'amount' => $amount,
                                    'discount' => $discount,
                                    'balance' => Helper::getStudentCurrentBalance($student->id),
                                    'total' => $total]);

                }catch (\Illuminate\Database\QueryException $e){
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062){
                        session()->flash('flash_message', 'Hey, these guys have been invoiced');
                        return \Redirect::back();
                    }
                }
        }
        //change the status of the fee schedule after billing class
        FeeSchedule::where('fee_schedule_code', $fee_schedule_code)->update(['status_id' => 8]);

        //get invoices
        $invoices = Invoice::where('fee_schedule_code', $fee_schedule_code)->get();

        return redirect()->to('billing/invoices')->with(['class_id'=>$fee_schedule->class_id, 
                                                            'session'=>$fee_schedule->session,
                                                            'term_id'=>$fee_schedule->term_id,
                                                            'invoices'=> $invoices]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function class_invoices(Request $request){
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
        //ensure at least on element was selected
        $data['title'] = 'Invoices';
        $data['invoice_menu'] = 1;
        
        // {class_id}{session}{term_id}
        $fee_schedule_code = strval($request->class_id).($request->session).strval($request->term_id);
        
        $data['session'] = $request->session;

        $data['class'] = StudentClass::findOrFail($request->class_id)->name;

        $data['term'] = $request->term_id;

        //get invoices
        $data['invoices'] = Invoice::where('fee_schedule_code', $fee_schedule_code)->get();

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

        return view('billing.invoices.class_invoices', $data);
    }

}
