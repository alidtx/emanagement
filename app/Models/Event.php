<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
 

    public function designationWiseEvent()
    {
        return $this->hasMany(DesignationWiseAmount::class);
    }
    public function designationwiseAmounts()
    {
        return $this->hasMany(DesignationwiseAmount::class, 'event_id');
    }
    public function eventPayment()
    {
        return $this->belongsTo(Payment::class,'id','event_id');
    }


   
 
        

}
