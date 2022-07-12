<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use \Znck\Eloquent\Traits\BelongsToThrough;



class Query extends Model
{
    use HasFactory;
    use BelongsToThrough;
    protected $fillable = [
        'user_id',
        'main_files_content_id',
        'parent_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Query::class, 'parent_id');
    }

    public function filename()
    {
        return $this->hasOneThrough(MainFolderFile::class, MainFilesContent::class);
    }


    public function fileContent()
    {
        return $this->belongsTo(MainFilesContent::class);
    }

    public function queryfile(){
        return $this->belongsToThrough(MainFolderFile::class, MainFilesContent::class);
    }
}
