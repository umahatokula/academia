<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FeeElement;
use \App\ChartOfAccount;

class feeElementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Fee Elements';
        $data['fee_elements_menu'] = 1;
        $data['fee_elements'] = FeeElement::all();

        return view('billing.fee_elements.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Fee Elements';
        $data['fee_elements_menu'] = 1;

        return view('billing.fee_elements.create');
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
        $rules = ['code'=>'required', 'name'=>'required', 'description'=>'required'];
        $this->validate($request, $rules);

        $fee_element = FeeElement::create($request->all());
        // dd($fee_element->id);

        //get the last radix number
        $last_radix_no = ChartOfAccount::where(['id_parent' => 52])->max('radix_no');
        $this_radix_no =  $last_radix_no + 1;

        ChartOfAccount::create([
                                'item_title'        => $request->name,
                                'account_code'      => $fee_element->id,
                                'radix_no'          => $this_radix_no,
                                'parent_radix_id'   => 52,
                                'item_level'        => 2,
                                'id_parent'         => 52,
                                ]);

        session()->flash('flash_message', 'Element created');

        return redirect('billing/fee_elements');
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
        $data['title'] = 'Edit Fee Element';
        $data['fee_elements_menu'] = 1;
        $data['fee_element'] = FeeElement::find($id);

        return view('billing.fee_elements.edit', $data);
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
        $rules = ['code'=>'required', 'name'=>'required', 'description'=>'required'];
        $this->validate($request, $rules);

        $fee_element = FeeElement::find($id);
        $fee_element->fill($request->all())->save();

        session()->flash('flash_message', 'Element edited');

        return redirect('billing/fee_elements');
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
        $fee_element = FeeElement::find($id);
        $fee_element->status_id = 1;
        $fee_element->save();

        return redirect('billing/fee_elements');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $fee_element = FeeElement::find($id);
        $fee_element->status_id = 2;
        $fee_element->save();

        return redirect('billing/fee_elements');
    }
}
