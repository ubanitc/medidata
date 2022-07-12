<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_id',
        'site_number',
        'site_name',
        'country',
        'investigator_name',
        'investigator_email'
    ];


    public function subjects(){
        return $this->hasMany(Subject::class);
    }

}
