<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;


class SubQuery extends Model
{
    use HasFactory;
    use BelongsToThrough;

    protected $fillable = [
        'user_id',
        'sub_files_content_id',
        'parent_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(SubQuery::class, 'parent_id');
    }

    public function subqueryfile(){
        return $this->belongsToThrough(SubFolderFile::class, SubFilesContent::class);
    }
}
