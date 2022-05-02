<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    public function doctorAppointment(){
        return $this->belongsToMany(DoctorAppointment::class, 'doctor_hour_appointments', 'doctor_appointment_id','hour_id');
    }

    protected $fillable=['hour','type'];
}
