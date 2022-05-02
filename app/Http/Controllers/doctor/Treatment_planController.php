<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Treatment_planController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sessions = DB::table('sessions')->where('sessions.user_id',$id)
        ->Join('users', 'users.id', '=', 'sessions.doctor_id')
        ->Join('treatments', 'treatments.id', '=', 'sessions.treatment_id')
        ->Join('treatment_appointments', 'treatment_appointments.id', '=', 'sessions.treatment_appointment_id')
        ->selectRaw('sessions.doctor_id,sessions.id,users.name,users.image,sessions.num,sessions.type,
        treatments.treatment,treatment_appointments.from,treatment_appointments.to,sessions.status,treatment_appointments.day , treatment_appointments.date ,sessions.description')
        ->get();
        $patient =  User::find($id);
        $days=['السبت','الأحد' ,'الأثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];
        $all_status=['On Time' ,'scheduled in time', 'cancelled by doctor','finished','Ready to start'];

        return view('doctor.treatment_plans.show',
        ['sessions'=>$sessions, 'days'=>$days , 'patient'=>$patient, 'all_status'=>$all_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session= Session::find($id);
        $session->status= $request->status;
        $session->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
