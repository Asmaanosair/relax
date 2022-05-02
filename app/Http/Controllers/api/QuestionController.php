<?php

namespace App\Http\Controllers\api;
use App\Clinic;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public  function question(){
        try {
            $question=Question::first();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $question,
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }
    }
    public  function answer(Request $request){
        try {
            $question=Question::findOrFail($request->id,array('answer','clinic_id'));
            if($request->answer==0){
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' => $question,
                ], 200);
            }
            $nextQuestion=Question::where('id', '>', $request->id)->select('id','question')->first();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $nextQuestion,
            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }
    }
    public  function doctor(Request $request){
        try {
            $data = DB::table('doctor_clinics')->where('clinic_id',$request->clinic_id)
                ->leftJoin('reviews', 'doctor_clinics.id', '=', 'reviews.doctor_id')
                ->Join('users', 'users.id', '=', 'doctor_clinics.user_id')
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
    public  function allDoctors(Request $request){
        try {
            $data = DB::table('doctor_clinics')
                ->leftJoin('reviews', 'doctor_clinics.id', '=', 'reviews.doctor_id')
                ->Join('users', 'users.id', '=', 'doctor_clinics.user_id')
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
    public  function clinic(Request $request){
        try {
            $clinic=Clinic::select('id','clinic','image')->get();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $clinic,
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
