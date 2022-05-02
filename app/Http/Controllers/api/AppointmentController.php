<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public  function upcoming(Request $request){
        try {
            $user=auth('api')->user()->id;
            $data = DB::table('appointments')->where('appointments.user_id',$user)
                ->Join('users', 'users.id', '=', 'appointments.doctor_id')
                ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
                ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
                ->selectRaw('appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,appointments.status')
                ->whereDate('doctor_appointments.date','>',date('y-m-d'))
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
    public  function history(Request $request){
        try {
          $user=auth('api')->user()->id;
            $data = DB::table('appointments')->where('appointments.user_id',$user)
                ->Join('users', 'users.id', '=', 'appointments.doctor_id')
                ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
                ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
                ->selectRaw('appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,appointments.status')
                ->whereDate('doctor_appointments.date','<',date('y-m-d'))
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
    public  function detail(Request $request){
        try {
            $data = DB::table('appointments')->where('appointments.id',$request->id)
                ->Join('users', 'users.id', '=', 'appointments.doctor_id')
                ->Join('doctor_clinics', 'users.id', '=', 'doctor_clinics.user_id')
                ->Join('payment_methods', 'payment_methods.id', '=', 'appointments.payment_method_id')
                ->Join('nationalities', 'nationalities.id', '=', 'doctor_clinics.nationality_id')
                ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
                ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
                ->selectRaw('appointments.id,users.name,users.image,doctor_appointments.date,
                doctor_appointments.day,hours.hour,hours.type,appointments.status,doctor_clinics.id,
                doctor_clinics.user_id,doctor_clinics.price,doctor_clinics.job_title,
                nationalities.flag,users.name,users.image,payment_methods.payment_method,payment_methods.image as payment_image')
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
    public  function appointment(Request $request){
        try {
            $user=auth('api')->user()->id;
            $data = DB::table('internal_appointments')->where('internal_appointments.user_id',$user)
                ->Join('users', 'users.id', '=', 'internal_appointments.doctor_id')
                ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'internal_appointments.doctor_appointment_id')
                ->Join('hours', 'hours.id', '=', 'internal_appointments.hour_id')
                ->selectRaw('internal_appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,internal_appointments.status')
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
    public  function appointmentDetails(Request $request){
        try {
            $data = DB::table('internal_appointments')->where('internal_appointments.id',$request->id)
                ->Join('users', 'users.id', '=', 'internal_appointments.doctor_id')
                ->Join('doctors', 'users.id', '=', 'doctors.user_id')
                ->Join('nationalities', 'nationalities.id', '=', 'doctors.nationality_id')
                ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
                ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
                ->selectRaw('internal_appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,internal_appointments.status,doctors.id,doctors.user_id,doctors.price,doctors.job_title,nationalities.flag,users.name,users.image')

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
