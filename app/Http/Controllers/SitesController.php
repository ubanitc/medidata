<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Study;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Study $study)
    {
        return view('sites', compact('study'));

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
    public function store(Request $request, Study $study)
    {
       $request->validate([
           'site_name'=>'required',
           'country'=>'required'
       ]);

     $site =  $study->sites()->create([
           'study_id'=>$study->id,
           'site_name'=>$request->site_name,
           'country'=>$request->country,
       ]);

     $site->site_number = str_pad($site->id, 3, 0, STR_PAD_LEFT);

     $site->save();
     session()->flash('success',$request->site_name);
     return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function show(Sites $sites)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function edit(Sites $sites)
    {
        return "this will be used to edit the sites info";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sites $sites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sites  $sites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sites $sites)
    {
        //
    }
}
