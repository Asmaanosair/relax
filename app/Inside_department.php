<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inside_department extends Model
{
    protected $fillable=[
        'admin_id','name','variable_activity_id',
        'permanent_activity_id','psychologist_id','sociologist_id',
        'activity_executor_id','psychologist_helper_id'];


    public function getDoctorName($user_id){

        $doctor = Doctor::find($user_id);
        if($doctor){
        return $doctor->user->name ;
        }else{
            return false;
        }
     }


     public function getPermanentActivities(){

        $permanent_activities_id = explode('-',$this->permanent_activity_id );
        foreach( $permanent_activities_id  as $permanent_activity_id ){
            $activity=Activity::find($permanent_activity_id);
            echo "<li>". $activity->name . "</li>";
        }
     }


     public function getVariableActivities(){

        $variable_activities_id = explode('-',$this->variable_activity_id );
        foreach( $variable_activities_id  as $variable_activity_id ){
            $activity=Activity::find($variable_activity_id);
            echo "<li>". $activity->name . "</li>";
        }
     }




    public function hours(){
        return $this->belongsToMany(Hour::class, 'doctor_hour_appointments', 'doctor_appointment_id','hour_id');
    }


     public function patients (){
          return $this->belongsToMany(User::class, 'department_patients', 'inside_department_id' , 'patient_id');

     }
}
