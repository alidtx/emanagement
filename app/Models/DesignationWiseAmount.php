<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationWiseAmount extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function designations()
    {
        return $this->belongsTo(DesignationWiseAmount::class, 'designation_id');
    }
}
