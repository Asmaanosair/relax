<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id', 'num', 'description',
        'status', 'type', 'treatment_id', 'treatment_appointment_id'
    ];


    public function treatmentAppointment(){
        return $this->belongsTo(TreatmentAppointment::class);
    }

    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }
}
