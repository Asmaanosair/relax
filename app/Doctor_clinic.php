<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor_clinic extends Model
{
    protected $fillable = [
        'details','nationality_id','job_title','price','user_id','clinic_id'
        ];
    
        public function user(){
        return $this->belongsTo(User::class);
        }
}
