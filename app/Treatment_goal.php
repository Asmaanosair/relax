<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment_goal extends Model
{
    protected $fillable = [
        'user_id','goals'
    ];
}
