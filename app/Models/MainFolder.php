<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'folder_name'
    ];

    public function main_folder_files(){
        return $this->hasMany(MainFolderFile::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}
