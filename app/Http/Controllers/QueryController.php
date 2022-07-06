<?php

namespace App\Http\Controllers;

use App\Models\MainFilesContent;
use App\Models\Query;
use App\Models\SubFilesContent;
use App\Models\SubQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{

    public function store(Request $request){
        $request->validate([

            'body'=>'required',

        ]);


        $input['body'] = $request->body;
        $input['user_id'] = Auth::id();


            if ($request->content_type == 1){
                $input['main_files_content_id'] = $request->content_id;
                Query::create($input);

            }else{
                $input['sub_files_content_id'] = $request->content_id;
                SubQuery::create($input);
            }



        return back();
    }
}
