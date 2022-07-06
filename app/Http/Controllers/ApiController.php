<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Study;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sites($id){
        return datatables(Sites::select('id','site_number','site_name','country','investigator_name','investigator_email')->where('study_id',$id))->toJson();
    }
}
