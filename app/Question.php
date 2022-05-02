<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question','answer','clinic_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
