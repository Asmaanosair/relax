<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Inside_department;
use App\Department_patient;
use App\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $user_id =auth()->user()->id;
        $doctor = Doctor::where('user_id',$user_id)->get()->first();
        $inside_department = Inside_department::where('admin_id',$doctor->id)
        ->orWhere('psychologist_id',$doctor->id)
        ->orWhere('sociologist_id',$doctor->id)
        ->orWhere('activity_executor_id',$doctor->id)
        ->orWhere('psychologist_helper_id',$doctor->id)
        ->get()->first();
        if($inside_department->count() > 0){
        $patients_id = Department_patient::where('inside_department_id',$inside_department->id)->get();
    }  else{
        $patients_id =[];
    }



        return view('doctor.chat.index', [
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

        $user_id =auth()->user()->id;
        $doctor = Doctor::where('user_id',$user_id)->get()->first();
        $inside_department = Inside_department::where('admin_id',$doctor->id)
        ->orWhere('psychologist_id',$doctor->id)
        ->orWhere('sociologist_id',$doctor->id)
        ->orWhere('activity_executor_id',$doctor->id)
        ->orWhere('psychologist_helper_id',$doctor->id)
        ->get()->first();
        if($inside_department->count() > 0){
        $patients_id = Department_patient::where('inside_department_id',$inside_department->id)->get();
    }  else{
        $patients_id =[];
    }

        return view('doctor.chat.show', [
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
