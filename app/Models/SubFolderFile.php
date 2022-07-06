<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFolderFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_folder_id',
        'file_name'
    ];

    public function contents(){
        return $this->hasMany(SubFilesContent::class);
    }
}
