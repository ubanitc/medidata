<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
class VerificationPdfController extends Controller
{
    public function downloadpdf($id)
    {
        $study = Study::find($id);
        $main_query = $study->queries()->where('parent_id', null)->where('opened', 0);
        $sub_query = $study->sub_queries()->where('parent_id', null)->where('opened', 0);

//       dd($main_query->filename());
        $unverified = $study->fileContent()->where('status', 0)->get();
        $unverified_file_name = $unverified->map(function ($item) {
            return $item->mainFolderFile;
        });
        $unverified_folder_name = $unverified_file_name->map(function ($item) {
            return $item->foldername;
        });
        $unverified_subject_name = $unverified_folder_name->map(function ($item) {
            return $item->subject;
        });

        $unverified_site_name = $unverified_subject_name->map(function ($item) {
            return $item->site;
        });


        $subunverified = $study->subfileContent()->where('status', 0)->get();
        $subunverified_file_name = $subunverified->map(function ($item) {
            return $item->subFolderFile;
        });
        $subunverified_sub_folder_name = $subunverified_file_name->map(function ($item) {
            return $item->sub_folder;
        });
        $subunverified_sub_main_folder_name = $subunverified_sub_folder_name->map(function ($item) {
            return $item->sub_main_folder;
        });
        $subunverified_sub_main_subject_name = $subunverified_sub_main_folder_name->map(function ($item) {
            return $item->subject;
        });
        $subunverified_sub_main_site_name = $subunverified_sub_main_subject_name->map(function ($item) {
            return $item->site;
        });


//        dd($subunverified_sub_main_site_name);
        $details =['unverified' => $unverified, 'unverified_file_name' => $unverified_file_name, 'subunverified' => $subunverified, 'subunverified_file_name' => $subunverified_file_name,'unverified_folder_name' => $unverified_folder_name, 'unverified_subject_name' => $unverified_subject_name, 'unverified_site_name' => $unverified_site_name, 'study' => $study, 'subunverified_sub_folder_name' => $subunverified_sub_folder_name, 'subunverified_sub_main_folder_name' => $subunverified_sub_main_folder_name, 'subunverified_sub_main_site_name' => $subunverified_sub_main_site_name, 'subunverified_sub_main_subject_name' => $subunverified_sub_main_subject_name, ];
        $pdf = PDF::loadView('verificationpdfdownload', $details);
        return $pdf->download('verification_'.now().'.pdf');
//        return view('verificationpdfdownload', compact('unverified', 'unverified_file_name', 'subunverified', 'subunverified_file_name', 'unverified_folder_name', 'unverified_subject_name','unverified_site_name','study','subunverified_sub_folder_name','subunverified_sub_main_folder_name','subunverified_sub_main_site_name','subunverified_sub_main_subject_name'));
    }



    public function downloadquerypdf($id){
        $study = Study::find($id);
        $main_query = $study->queries()->where('parent_id', null)->where('opened', 0)->get();
        $main_query_file = $main_query->map(function ($item){
            return $item->queryfile;
        });
        $main_query_folder = $main_query_file->map(function ($item){
            return $item->foldername;
        });
        $main_query_subject = $main_query_folder->map(function ($item){
            return $item->subject;
        });

        $main_query_site = $main_query_subject->map(function ($item){
            return $item->site;
        });




        $sub_query = $study->sub_queries()->where('parent_id', null)->where('opened', 0)->get();
        $sub_query_sub_file = $sub_query->map(function ($item){
            return $item->subqueryfile;
        });
        $sub_query_sub_folder = $sub_query_sub_file->map(function ($item){
            return $item->sub_folder;
        });
        $sub_query_main_folder = $sub_query_sub_folder->map(function ($item){
                return $item->sub_main_folder;
            });
        $sub_query_subject_name = $sub_query_main_folder->map(function ($item){
            return $item->subject;
        });
        $sub_query_site_name = $sub_query_subject_name->map(function ($item){
            return $item->site;
        });

        $details = ['study'=>$study, 'main_query'=>$main_query, 'main_query_file'=>$main_query_file, 'main_query_folder'=>$main_query_folder, 'main_query_subject'=>$main_query_subject, 'main_query_site'=>$main_query_site, 'sub_query'=>$sub_query, 'sub_query_sub_file'=>$sub_query_sub_file, 'sub_query_sub_folder'=>$sub_query_sub_folder, 'sub_query_main_folder'=>$sub_query_main_folder, 'sub_query_subject_name'=>$sub_query_subject_name, 'sub_query_site_name'=>$sub_query_site_name,];
//        dd($sub_query_sub_folder);
        $pdf = PDF::loadView('querypdfdownload', $details);
        return $pdf->download('open_queries'.now().'.pdf');


//        return view('querypdfdownload', compact('main_query','sub_query','main_query_file','main_query_folder','main_query_subject','main_query_site','study','sub_query_sub_file','sub_query_sub_folder','sub_query_main_folder','sub_query_subject_name','sub_query_site_name'));
    }
}
