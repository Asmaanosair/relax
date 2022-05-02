<?php

namespace App\Http\Controllers\doctor;

use App\Appointment;
use App\Chat;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class Chat_clinicController extends Controller
{
    public function index()
    {

        $patients_id = Appointment::where('doctor_id', auth()->user()->id)->get('user_id');


        return view('doctor.chat_clinics.index', [
            'patients_id' => $patients_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $friend = User::Find($id);

        $patients_id = Appointment::where('doctor_id', auth()->user()->id)->get('user_id');

        return view('doctor.chat_clinics.show', [
            'friend' => $friend,
            'patients_id' => $patients_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function getChat($id)
    {

        $chats = Chat::where(function ($query) use ($id) {
            $query->where('user_id', '=', auth()->user()->id)->where('doctor_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', '=', $id)->where('doctor_id', '=', auth()->user()->id);
        })->get();

        return $chats;
    }



    public function sendChat(Request $request)
    {

        Chat::create([
            'user_id' => $request->user_id,
            'doctor_id' => $request->doctor_id,
            'message' => $request->message
        ]);


        return [];
    }
}
