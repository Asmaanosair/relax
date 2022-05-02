<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Notifications\ChatNotification;
use App\User;
use Illuminate\Http\Request;
use Notification;

class DoctorChatController extends Controller
{
    public function getAllChat()
    {

        try {
            $user_id = auth()->user()->id;
            $chats = Chat::where(function ($query) use ($user_id) {
                $query->where('user_id', '=', $user_id);
            })->orWhere(function ($query) use ($user_id) {
                $query->where('doctor_id', '=', $user_id);
            })->get();

            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $chats
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
            $user_id = auth()->user()->id;
            $chats = Chat::where(function ($query) use ($user_id, $doctor_id) {
                $query->where('user_id', '=', $user_id)->where('doctor_id', '=', $doctor_id);
            })->orWhere(function ($query) use ($user_id, $doctor_id) {
                $query->where('user_id', '=', $doctor_id)->where('doctor_id', '=', $user_id);
            })->get();


            if ($chats) {
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'message' => $chats
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
        $user=User::find(2);
        Notification::send($user ,new ChatNotification($request));

        try {
          //  $user_id = auth()->user()->id;
            $chat = Chat::create([
                'doctor_id' => 1,
                'user_id' => $request->user_id,
                'message' => $request->message
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

}
