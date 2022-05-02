<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Doctor;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','birthday','phone','image','user_role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function doctor(){
        return $this->hasOne(Doctor::class);
    }

    public function doctorClinic(){
        return $this->hasOne(Doctor_clinic::class);
    }

    public function isAdmin() {
        return $this->user_role === 0;
    }

    public function isPatient() {
        return $this->user_role === 2;
    }

    public function isInsideDoctor() {
        return $this->user_role === 1;
    }

    public function isClinicDoctor() {
        return $this->user_role === 3;
    }

    public function isExistInInsideDepartment($doctor_id) {
        $check = Inside_department::where('admin_id', $doctor_id)
            ->orWhere('psychologist_id', $doctor_id)
            ->orWhere('sociologist_id', $doctor_id)
            ->orWhere('activity_executor_id', $doctor_id)
            ->orWhere('psychologist_helper_id', $doctor_id)
            ->first();

        if (! $check) {
            return true;
        }
    }

    public function isExistInInsideDepartmentPatient($patient_id) {
        $check = Department_patient::where('patient_id',$patient_id)->first();

        if (! $check) {
            return true;
        }
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function patient(){
        return $this->hasOne(Patient::class);
    }

    public function insideDepartmentPatients() {
        return $this->hasOne(Department_patient::class, 'patient_id');
    }

    public function getImageAttribute($value)
    {
        return url($value);
    }
}
