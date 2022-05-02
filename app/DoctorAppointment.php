<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{

    public function hours(){
        return $this->belongsToMany(Hour::class, 'doctor_hour_appointments', 'doctor_appointment_id','hour_id');
    }

    protected $fillable =['doctor_id','date','day'];
}
