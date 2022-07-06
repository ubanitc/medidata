<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_folder_id',
        'folder_name',
    ];
}
