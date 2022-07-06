<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainFilesContent extends Model
{
    use HasFactory;

protected $fillable = [
    'main_folder_file_id',
    'question',
    'answer',
    'status',
    'type'
];
public function queries(){
    return $this->hasMany(Query::class)->whereNull('parent_id');
}
    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function mainFolderFile(){
    return $this->belongsTo(MainFolderFile::class, 'main_folder_file_id');
    }

    public function folder(){
        return $this->hasOneThrough(MainFolder::class, MainFolderFile::class);
    }
}
