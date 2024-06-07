<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $guarded = ["id", "created_at", "updated_at"];

    public function getFileImageAttribute()
    {
        return 'storage/' . $this->attributes['file_path'];
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class,'model_id','id');
    }
    public function chapter()
    {
        return $this->belongsTo(Chapters::class,'model_id','id');
    }
}
