<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Bank;
use \App\School;

class schoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'School Settings';
        $data['school_menu'] = 1;
        $data['school'] = School::find(1);
        return view('settings.school.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'School Settings';
        $data['school_menu'] = 1;
        $data['banks'] = Bank::lists('name', 'id')->prepend('Please Select');
        return view('settings.school.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->logo);
        $rules = [  'name'              => 'required',
                    'logo'              => 'required',
                    'line1'             => 'required',
                    'line2'             => 'required',
                    'line3'             => 'required',
                    'bank_id'           => 'required',
                    'account_name'      => 'required',
                    'account_number'    => 'required'];
        $this->validate($request, $rules);

        $data = School::find(1); 
        // dd($data);

        if (is_null($data)){
            $school = School::create($request->all());
            // dd($school->id);

            $imageName = $school->id.'.'.$request->logo->getClientOriginalExtension();

            // $imageName = str_replace(' ', '-', $request->name).'.'.$request->logo->getClientOriginalExtension();

            $request->logo->move(base_path().'/public/assets/images/logo/', $imageName);

            return redirect()->to('settings/school');

        }else{
            session()->flash('flash_message', 'School information has already been entered. You can update.');
            return redirect()->back()->withInput();
        }
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
}
