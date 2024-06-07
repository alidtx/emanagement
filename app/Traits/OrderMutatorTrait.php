<?php

namespace App\Traits;

trait OrderMutatorTrait
{
    public function setOrderAttribute($value)
    {
        // Check if $value is null
        if (is_null($value)) {
            // If it's null, unset the 'order' attribute
            unset($this->attributes['order']);
        } else {
            // If it's not null, set the 'order' attribute
            $this->attributes['order'] = $value;
        }
    }
}
