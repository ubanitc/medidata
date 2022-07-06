<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFilesContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_folder_file_id',
        'question',
        'answer',
        'status',
        'type'
    ];
    public function queries(){
        return $this->hasMany(SubQuery::class)->whereNull('parent_id');
    }

    public function notes(){
        return $this->hasMany(SubNote::class);

    }
}
