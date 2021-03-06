<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = [
        'nationality','flag'
    ];
    public function getFlagAttribute($value)
    {
        return url($value);
    }
}
