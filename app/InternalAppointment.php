<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalAppointment extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id', 'status', 'doctor_appointment_id', 'hour_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor_appointment()
    {
        return $this->belongsTo(DoctorAppointment::class);
    }
    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }

}
