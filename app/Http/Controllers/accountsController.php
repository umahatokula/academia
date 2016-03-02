<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use \App\Helpers\Helper;

use \App\Staff;
use \App\ChartOfAccount;
use \App\FeeSchedule;
use \App\FeeElement;
use \App\Invoice;

class accountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['title'] = 'Reports';
        $data['accounts_menu'] = 1;
        $data['coa_elements'] = ChartOfAccount::where(['id_parent' => 52])->lists('item_title', 'account_code');
        $data['search_dates'] = ['0' => 'Select Search Date', '1' => 'Last Week', '2' => 'Last Month', '3' => '3 Months Ago', '4' => '6 Months Ago', '5' => '1 Year Ago'];


        return view('accounts.reports.index', $data);
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

    public function reports_search(Request $request) {
        // dd($request);
        $fee_element_id = $request->fee_element_id;
        $search_by = $request->search_by;


        $data['title'] = 'Reports';
        $data['accounts_menu'] = 1;
        $data['coa_elements'] = ChartOfAccount::where(['id_parent' => 52])->lists('item_title', 'account_code');
        $data['search_dates'] = ['0' => 'Select Search Date', '1' => 'Last Week', '2' => 'Last Month', '3' => '3 Months Ago', '4' => '6 Months Ago', '5' => '1 Year Ago'];
        $data['result'] = 1;
        $data['total'] = Helper::reports_total_on_item($fee_element_id, $search_by);
        $data['search_item'] = FeeElement::find($fee_element_id)->first()->name;


        return view('accounts.reports.index', $data);
    }
}
