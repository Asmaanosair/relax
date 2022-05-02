<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentAppointment extends Model
{
    protected $fillable = [
        'date','day','from','to','treatment_id'
    ];
}
