<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
    'details','role_id','nationality_id','job_title','price','user_id','clinic_id'
    ];

    public function user(){
    return $this->belongsTo(User::class);
    }

    
    public function role(){
        return $this->belongsTo(Role::class);
    }
}
