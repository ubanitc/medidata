<?php

namespace App\Http\Controllers;

use App\Models\MainFilesContent;
use App\Models\MainFolder;
use App\Models\MainFolderFile;
use App\Models\SubFilesContent;
use App\Models\SubFolder;
use App\Models\SubFolderFile;
use App\Models\Subject;
use Illuminate\Http\Request;

class tableDashboardController extends Controller
{
    public function create_folder(Request $request){
        foreach ($request->folder_name as $folder_name){
            if ($folder_name != ''){
                MainFolder::create([
                    'subject_id'=>$request->subject_id,
                    'folder_name'=>$folder_name,
                ]);
            }
        }

        return redirect()->back();

    }


    public function create_sub_folder(Request $request){
        foreach ($request->sub_folder_name as $sub_folder_name){
            if ($sub_folder_name != ''){
                SubFolder::create([
                    'main_folder_id'=>$request->main_folder_id,
                    'folder_name'=>$sub_folder_name,
                ]);
            }
        }

        return back();
    }

    public function create_main_file(Request $request){
        foreach ($request->main_file_name as $main_file_name){
            if ($main_file_name != ''){
                MainFolderFile::create([
                    'main_folder_id'=>$request->main_file_id_get,
                    'file_name'=>$main_file_name,
                ]);
            }
        }

        return back();
    }


    public function create_sub_folder_file(Request $request){
        foreach ($request->sub_file_name as $sub_file_name){
            if ($sub_file_name != ''){
                SubFolderFile::create([
                    'sub_folder_id'=>$request->sub_file_id,
                    'file_name'=>$sub_file_name,
                ]);
            }
        }

        return back();
    }

    public function create_folder_content(Request $request){
        $questions = $request->questions;
        $answers = $request->answers;
            if ($request->type_id == 1){
                foreach($questions as $index => $question){
                    if ($question != null){
                        MainFilesContent::create([
                            'main_folder_file_id'=>$request->file_id,
                            'question'=>$question,
                            'answer'=>$answers[$index],
                            'status'=>0,
                            'type'=>$request->type_id,

                        ]);
                    }

                }
            }else{
                foreach($questions as $index => $question){
                    if ($question != null){
                        SubFilesContent::create([
                            'sub_folder_file_id'=>$request->file_id,
                            'question'=>$question,
                            'answer'=>$answers[$index],
                            'status'=>0,
                            'type'=>$request->type_id,

                        ]);
                    }

                }
            }
            return back();
    }
}
