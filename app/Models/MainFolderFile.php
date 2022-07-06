<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainFolderFile extends Model
{
    use HasFactory;

protected $fillable = [
    'main_folder_id',
    'file_name'
];

    public function contents(){
        return $this->hasMany(MainFilesContent::class);
    }
}
