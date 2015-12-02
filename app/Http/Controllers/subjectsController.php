<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\createSubjectRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Subject;

class subjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Subjects';
        $data['subjects'] = Subject::all();
        return view('settings.subjects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Subjects';
        return view('settings.subjects.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createSubjectRequest $request)
    {
        $subject = new Subject;
        $subject->create($request->all());

        session()->flash('flash_message', 'Subject successfully added.');

        return redirect('settings/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'Subjects';
        $data['subject'] = Subject::find($id);
        return view('settings.subjects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Subjects';
        $data['subject'] = Subject::find($id);
        return view('settings.subjects.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(createSubjectRequest $request, $id)
    {
        $subject = Subject::find($id);
        $subject->fill($request->all())->save();
        return redirect('settings/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject= Subject::find($id);
        $subject->delete();

        return $this->index();
    }
}
