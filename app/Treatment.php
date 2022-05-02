<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [
        'treatment','school_id'
    ];
    public function school(){
        return $this->belongsTo(School::class);
    }
}
