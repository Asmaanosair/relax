<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public  function sessions(Request $request){
        try {
            $user=auth('api')->user()->id;
            $data = DB::table('sessions')->where('sessions.user_id',$user)
                ->Join('users', 'users.id', '=', 'sessions.doctor_id')
                ->Join('treatments', 'treatments.id', '=', 'sessions.treatment_id')
                ->Join('treatment_appointments', 'treatment_appointments.id', '=', 'sessions.treatment_appointment_id')
                ->selectRaw('sessions.id,users.name,users.image,treatments.treatment,treatment_appointments.from,treatment_appointments.to,sessions.status,treatment_appointments.date')
                ->orderBy('treatment_appointments.date','desc')
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
    public  function prescription(Request $request){
        try {
            $user=auth('api')->user()->id;
            $data = DB::table('prescriptions')->where('prescriptions.user_id',$user)
                ->Join('users', 'users.id', '=', 'prescriptions.doctor_id')
                ->selectRaw('prescriptions.id,users.name,users.image,prescriptions.prescription')
                ->orderBy('prescriptions.id','desc')
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
