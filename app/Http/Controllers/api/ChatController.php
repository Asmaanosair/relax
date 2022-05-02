<?php

namespace App\Http\Controllers\api;

use App\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function getAllChat()
    {

        try {
            $user_id = auth('api')->user()->id;
            $chats = Chat::where(function ($query) use ($user_id) {
                $query->where('user_id', '=', $user_id);
            })->orWhere(function ($query) use ($user_id) {
                $query->where('doctor_id', '=', $user_id);
            })->get();

            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' => $chats
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }

    public function getChat($doctor_id)
    {

        try {
            $user_id = auth('api')->user()->id;
            $chats = Chat::where(function ($query) use ($user_id, $doctor_id) {
                $query->where('user_id', '=', $user_id)->where('doctor_id', '=', $doctor_id);
            })->orWhere(function ($query) use ($user_id, $doctor_id) {
                $query->where('user_id', '=', $doctor_id)->where('doctor_id', '=', $user_id);
            })->get();


            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' => $chats
                ], 201);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }



    public function sendChat(Request $request)
    {

        try {
            $user_id = auth('api')->user()->id;
            $chat = Chat::create([
                'user_id' => $user_id,
                'doctor_id' => $request->doctor_id,
                'message' => $request->message,
                'sender' => 0
            ]);

                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                   'data' => $chat
                ], 201);


        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public  function doctors(Request $request){
        try {
            $user=auth('api')->user()->id;
            $data = DB::table('sessions')->where('sessions.user_id',$user)
                ->Join('users', 'users.id', '=', 'sessions.doctor_id')
                ->selectRaw('users.id,users.name,users.image')
                ->distinct()
//                ->orderBy('sessions.date','desc')
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
