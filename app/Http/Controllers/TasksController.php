<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Study;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function tasks($id){

        $study = Study::find($id);
       $main_query = $study->queries()->where('parent_id', null)->where('opened',0);
       $sub_query = $study->sub_queries()->where('parent_id', null)->where('opened',0);

//       dd($main_query->filename());
        $unverified = $study->fileContent()->where('status',0)->get();
       $unverified_file_name = $study->fileContent()->where('status',0)->get()->map(function ($item){
            return $item->mainFolderFile;
       });
       $subunverified = $study->subfileContent()->where('status',0)->get();
        $subunverified_file_name = $study->subfileContent()->where('status',0)->get()->map(function ($item){
            return $item->subFolderFile;
        });


//        dd($subunverified_file_name);
      return view('tasks', compact('main_query', 'sub_query','unverified', 'subunverified','id'));
    }
}
