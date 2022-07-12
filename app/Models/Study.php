<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;


class Study extends Model
{
    use HasRelationships;

    protected $fillable = [
        'study_name',
        'protocol_id',
        'indication',
        'phase'
    ];

    use HasFactory;




    public function sites(){
        return $this->hasMany(Sites::class);
    }

    public function queries(){
        return $this->hasManyDeep(Query::class,[Sites::class,Subject::class, MainFolder::class, MainFolderFile::class, MainFilesContent::class]);
    }

    public function sub_queries(){
        return$this->hasManyDeep(SubQuery::class,[Sites::class,Subject::class, MainFolder::class, SubFolder::class, SubFolderFile::class, SubFilesContent::class]);
    }

    public function fileContent(){
        return $this->hasManyDeep(MainFilesContent::class,[Sites::class,Subject::class, MainFolder::class, MainFolderFile::class]);
    }

//    public function mainFolderFile(){
//        return $this->belongsTo(MainFolderFile::class);
//    }

    public function subfileContent(){
        return$this->hasManyDeep(SubFilesContent::class,[Sites::class,Subject::class, MainFolder::class, SubFolder::class, SubFolderFile::class]);
    }
}
