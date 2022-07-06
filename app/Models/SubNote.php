<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubNote extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'sub_files_content_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
