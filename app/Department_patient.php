<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_patient extends Model
{
 protected $fillable =['patient_id' , 'inside_department_id'];

 public function user(){
     return $this->belongsTo(User::class) ; 
 }

}
