<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Study;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function tasks($id){

        $study = Study::find($id);
       $main_query = $study->queries()->where('parent_id', null)->where('opened',0)->get();
       $sub_query = $study->sub_queries()->where('parent_id', null)->where('opened',0)->get();

//       dd($main_query->filename());

       $unverified = $study->fileContent()->where('status',0)->get();
       $subunverified = $study->subfileContent()->where('status',0)->get();


      return view('tasks', compact('main_query', 'sub_query','unverified', 'subunverified'));
    }
}
