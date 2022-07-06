<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Study;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Study $study, Sites $site)
    {
        return view('subjects', compact('study','site'));

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
    public function store(Request $request, Study $study, Sites $site)
    {

        $request->validate([
            'subject_status'=>'required'
        ]);

      $subject =  $site->subjects()->create([
            'sites_id'=>$site->id,
            'subject_status'=>$request->subject_status,
        ]);


      $subject->subject_id = str_pad($subject->id, 4, 0, STR_PAD_LEFT);
      $subject->save();

      return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Study $study, Sites $site, Subject $subject)
    {
        return  view('subjects-tables');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
