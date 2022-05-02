<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\Doctor;
use App\Doctor_clinic;
use App\DoctorAppointment;
use App\DoctorHourAppointment;
use App\Http\Controllers\Controller;
use App\Review;
use App\Schedule;
use App\ScheduleDoctors;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public  function details(Request $request){
        try {

           // $user=User::find(13)->select('id','name','image');
           $user=User::where('id',$request->user_id)->select('id','name','image')->first();
            $doctor=Doctor_clinic::where('user_id',$request->user_id)->first();
            $review=Review::where('doctor_id',$request->user_id)->avg('rate');
            $sessions=Session::where('doctor_id',$request->user_id)->count();
            $user['job_title']=$doctor->job_title;
            $user['price']=$doctor->price;
            $user['review']=$review;
            $user['sessions']=$sessions;
            $schedule=DoctorAppointment::where('doctor_id',$request->user_id)->get();
            $data=[];
            foreach ($schedule as $row){
                $schedule_hours=DoctorAppointment::select('id','date','day')->find($row->id);
                $hours=$schedule_hours->hours;
                $hours->makeHidden(['pivot','created_at','updated_at']);
                array_push($data,$schedule_hours);
            }
            $user['schedule']=$data;
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }
    }
    public  function appointment(Request $request){
        try {
           $user=auth('api')->user()->id;
           $appointment = new Appointment();
            $appointment->user_id= $user;
            $appointment->doctor_id= $request->user_id;
            $appointment->hour_id= $request->hour_id;
            $appointment->doctor_appointment_id= $request->schedule_id;
            $appointment->payment_method_id= 1 ;
            $appointment->save();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $appointment,
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }
    }
    public  function search(Request $request){
        try {
            $data = DB::table('users')->where('name', 'LIKE', '%' . $request->search . '%')
                ->Join('doctor_clinics', 'doctor_clinics.user_id', '=', 'users.id')
                ->leftJoin('reviews', 'doctor_clinics.id', '=', 'reviews.doctor_id')
                ->Join('clinics', 'clinics.id', '=', 'doctor_clinics.clinic_id')
                ->Join('nationalities', 'nationalities.id', '=', 'doctor_clinics.nationality_id')
                ->selectRaw('doctor_clinics.id,doctor_clinics.user_id,doctor_clinics.price,doctor_clinics.job_title,nationalities.flag,clinics.clinic,users.name,users.image, COALESCE(AVG(reviews.rate),0 )as rates,COUNT(reviews.doctor_id) as count')
                ->groupBy('doctor_clinics.id')
                ->orderBy('rates','desc')
                ->get();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,
            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }

    }
}
