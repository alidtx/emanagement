<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    public static function find($key)
    {
        return self::where('key', $key)->first()->value ?? null;
    }

    public static function set($key, $value)
    {

        $item = self::where('key', $key)->first();

        if (!$item) {
            $item = new self();
        }

        $item->key = $key;
        $item->value = $value;
        $item->save();

        return false;
    }
}
