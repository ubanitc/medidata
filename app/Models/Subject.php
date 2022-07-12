<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Subject extends Model
{
    use HasFactory;
    use HasRelationships;
    protected $fillable = [
        'sites_id',
        'subject_id',
        'subject_status'
    ];

    public function main_folders(){
        return $this->hasMany(MainFolder::class);
    }

    public function main_folder_files(){
        return $this->hasManyThrough(MainFolderFile::class, MainFolder::class);
    }

    public function sub_folders(){
        return $this->hasManyThrough(SubFolder::class, MainFolder::class);
    }

    public function sub_folder_files(){
        return $this->hasManyDeep(SubFolderFile::class, [ MainFolder::class , SubFolder::class]);
    }

    public function site(){
        return $this->belongsTo(Sites::class, 'sites_id');
    }
}
