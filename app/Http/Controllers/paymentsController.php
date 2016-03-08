<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\FeeSchedule;
use \App\Helpers\PaymentHelper;

use \App\studentClass;
use \App\Student;
use \App\Invoice;
use \App\CurrentTerm;
use \App\SchoolFeesPayment;

use DB;

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
        $data['students'] = Student::all();

        $data['student_info'] = [];
        $data['student_invoice'] = [];
        $data['student_fee_elements'] = [];
        $data['exempted_elements'] = [];
        $data['already_paid'] = [];
        // $data['outstanding_fee_schedule_code'] = '';
        // $data['outstanding_class_id'] = 0;
        $data['fees'] = 0;

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
        $data['title'] = 'Pay School Fees';
        $data['fees'] = 1;
        $class_id = $request->class_id;
        $student_id = $request->student_id;
        $fee_schedule_code = strval($class_id).(session()->get('current_session')).strval(session()->get('current_term'));

        $session = session()->get('current_session');
        $term = session()->get('current_term');

        //current session invoice table
        $table = 'invoices_'.$session.'_'.$term;
        $data['student_fee_elements'] = [];

        
        //==============get previous sessions fees not yet paid+++++++++++++
        $sessions = CurrentTerm::orderBy('created_at', 'desc')->where('session', '!=', session()->get('current_session'))->orWhere('term', '!=', session()->get('current_term'))->take(9)->groupby('session')->get();
        // dd($sessions);

        $outstandings = [];
        $invoices_amt = 0;
        $payment_amt = 0;


        // foreach ($sessions as $session) {

            $invoices = Invoice::where('session', '!=', session()->get('current_session'))->orWhere('term', '!=', session()->get('current_term'))->get();
            // dd($invoices);

            //get all payments associated with an invoice
            foreach ($invoices as $invoice) {
                $payment_amt = 0;
                $student_invoice = DB::table($invoice->table_name)->where(['student_id' => $student_id])->first();

                //for every invoice, get payment associated with that invoice
                if ($student_invoice !== null) {
                    $sch_fee_payment = SchoolFeesPayment::where(['session' => $invoice->session, 'term' => $invoice->term])->first();
                    $paid_amt = DB::table($sch_fee_payment->table_name)->where(['student_id' => $student_id])->sum('amount');

                    //get class id from fee schedule code
                    $outstanding_class_id = substr($student_invoice->fee_schedule_code, 0, 1);

                    //get oustanding amount
                    $outstanding_balance = $student_invoice->total - $paid_amt;

                    //if outstanding amt is not greater than zero then student has paid fully for that invoice therefore dont show on page
                    if ($outstanding_balance > 0 ) {
                        $session_fees = ['session' => $invoice->session, 'term' => $invoice->term, 'outstanding_balance' => $outstanding_balance, 'sch_fee_payment_table_name' => $sch_fee_payment->table_name, 'outstanding_fee_schedule_code' => $student_invoice->fee_schedule_code, 'outstanding_class_id' => $outstanding_class_id]; 
                        array_push($outstandings, $session_fees);
                    }


                }
                
            }

        // }

        if ($outstandings == []) {
            $outstandings = null;
        }
        $data['outstandings'] = $outstandings;




        //===========GET THIS SESSIONS FEES++++++++++++++++++

        //get fee schedule elements for current session
        $fee_sch_table = 'fee_sch_'.session()->get('current_session').'_'.session()->get('current_term');
        

        //get student invoice including exmepted fee elements
        $data['student_invoice'] = \DB::table($table)->where(['student_id' => $student_id, 'fee_schedule_code' => $fee_schedule_code])->first();

        // dd($data['student_invoice'] );
        // 

        //check if invoice has been generated for this student
        if ($data['student_invoice'] !== null) {
            $already_paid = [];
            $paid_amount = 0;
            $data['exempted_elements'] = json_decode($data['student_invoice']->exempted_fee_elements);
            if ($data['exempted_elements'] == null) {
                $data['exempted_elements'] = [];
            }

            $sch_fee_payment = SchoolFeesPayment::where(['session' => session()->get('current_session'), 'term' => session()->get('current_term')])->first();

            $payment_histories = DB::table($sch_fee_payment->table_name)->where(['student_id' => $student_id])->get();
            // dd($payment_histories);

            foreach ($payment_histories as $payment_history) {
                $already_paid[] = json_decode($payment_history->elements_paid_for);
                $paid_amount += $payment_history->amount;
            }

            $already_paid = array_flatten($already_paid);
            // dd($already_paid);
            if($already_paid !== null){
                $data['already_paid'] = $already_paid;
            } else {
                $data['already_paid'] = [];
            }
            

            //get oustanding amount
            $outstanding_balance = $data['student_invoice']->total - $paid_amount;

            if($outstanding_balance > 0) {
                $data['student_fee_elements'] = DB::table($fee_sch_table)->where(['fee_schedule_code' => $fee_schedule_code])
                ->join('fee_elements', 'fee_elements.id', '=', $fee_sch_table.'.fee_element_id')
                ->get();
            }

            
        } else{
            session()->flash('flash_message', 'An invoice has not been generated for this term for this student.');
        } 


        if ($data['outstandings'] !== null || $data['student_invoice'] !== null) {

            $sch_fee_payments = SchoolFeesPayment::all();
            foreach ($sch_fee_payments as $sch_fee_payment) {
                $term_payments = DB::table($sch_fee_payment->table_name)->where('student_id', $student_id)->orderBy('created_at', 'desc')->get();
                $payments[] = $term_payments;
            }
            // dd(array_flatten($payments));
            $data['payments'] = array_flatten($payments);

            $data['student_info'] = Student::find($student_id);
            $data['classes'] = studentClass::lists('name', 'id')->prepend('Please Select');
            $data['students'] = Student::all();
            

            return view('payments.payments', $data);
        } else {
            session()->flash('flash_message', 'An invoice has not been generated for this student.');
            return redirect()->route('accounts.payments.index');
        }

    }


    public function store_pay_invoice(Request $request) {
        // dd($request->all());
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $fee_schedule_code = $request->fee_schedule_code;
        // $elements_paid_for = $request->elements_paid_for;
        $elements_paid_for = $request->elements_paid_for;
        $this_term_amount = $request->this_term_amount;
        $outstanding_fees = $request->outstanding_fees;
        $outstanding_amounts = $request->outstanding_amounts;
        $outstanding_fee_schedule_code = $request->outstanding_amounts;

        //-----CURRENT TERM============
        if (isset($elements_paid_for) && isset($this_term_amount)) {

            $sch_fee_pay_table = 'sch_fee_pay_'.session()->get('current_session').'_'.session()->get('current_term');
            DB::table($sch_fee_pay_table)->insert([
                'student_id' => $student_id,
                'fee_schedule_code' => $fee_schedule_code,
                'outstanding_balance' => 0,
                'amount' => array_sum($this_term_amount),
                'elements_paid_for' => json_encode($elements_paid_for),
                'session' => session()->get('current_session'),
                'term_id' => session()->get('current_session'),
                'class_id' => $class_id,
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
                ]);

        }
        

        //=========OUTSTANDING FEES============
        if (isset($outstanding_fees) && isset($outstanding_amounts)) {

            for ($i=0; $i < count($outstanding_fees); $i++) { 
                $table_name = $outstanding_fees[$i];
                DB::table($table_name)->insert([
                    'student_id' => $student_id,
                    'outstanding_balance' => 0,
                    'amount' => $outstanding_amounts[$i],
                    'elements_paid_for' => json_encode([]),
                    'session' => $request->outstanding_session[$i],
                    'term_id' => $request->outstanding_term[$i],
                    'class_id' => $request->outstanding_class_id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s')
                    ]);
            }


        }

        

        

        return redirect()->route('accounts.payments.index');
    }
}
