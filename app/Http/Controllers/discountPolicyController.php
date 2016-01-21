<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FeeElement;
use App\DiscountPolicy;
use App\DiscountDuration;

class discountPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Discont Policies';
        $data['discount_policies_menu'] = 1;

        return view('billing.discount_policies.index', $data);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_parent_policy($id = 1)
    {
        $data['discount_policy'] = DiscountPolicy::find($id);
        $data['fee_elements'] = FeeElement::lists('name', 'id');
        $data['discount_durations'] = DiscountDuration::lists('duration', 'id')->prepend('Please select');
        return view('billing.discount_policies.edit_parent_policy', $data);
    }

        public function update_parent_policy(Request $request)
    {
        // dd($request);
        $discountPolicy = DiscountPolicy::find(1);
        $discountPolicy->children_number = $request->children_number;
        $discountPolicy->all_wards = $request->all_wards;
        $discountPolicy->dont_divide = $request->dont_divide;
        $discountPolicy->type = $request->type;
        $discountPolicy->discount_duration = $request->discount_duration;
        $discountPolicy->ward_to_deduct = $request->ward_to_deduct;
        $discountPolicy->percentage_value = $request->percentage_value;
        $discountPolicy->affected_elements = json_encode($request->affected_elements);
        $discountPolicy->sum_value = $request->sum_value;

        $discountPolicy->save();

        return redirect()->back();

    }


            /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_staff_policy($id = 2)
    {
        $data['discount_policy'] = DiscountPolicy::find($id);
        $data['fee_elements'] = FeeElement::lists('name', 'id');
        $data['discount_durations'] = DiscountDuration::lists('duration', 'id')->prepend('Please select');
        return view('billing.discount_policies.edit_staff_policy', $data);
    }

        public function update_staff_policy(Request $request)
    {
        // dd($request);
        $discountPolicy = DiscountPolicy::find(2);
        $discountPolicy->children_number = $request->children_number;
        $discountPolicy->all_wards = $request->all_wards;
        $discountPolicy->dont_divide = $request->dont_divide;
        $discountPolicy->type = $request->type;
        $discountPolicy->discount_duration = $request->discount_duration;
        $discountPolicy->ward_to_deduct = $request->ward_to_deduct;
        $discountPolicy->percentage_value = $request->percentage_value;
        $discountPolicy->affected_elements = json_encode($request->affected_elements);
        $discountPolicy->sum_value = $request->sum_value;

        $discountPolicy->save();

        return redirect()->back();
    }


            /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_scholarship_policy()
    {
        //
    }

    /**
     * [store_scholarship_policy description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
        public function update_scholarship_policy(Request $request)
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
}
