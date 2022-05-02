<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\DoctorAppointment;
use App\User;
use Illuminate\Support\Facades\DB;

class Appointment_patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = DB::table('appointments')->where(['appointments.doctor_id' => auth()->user()->id])
            ->Join('users', 'users.id', '=', 'appointments.user_id')
            ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
            ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
            ->selectRaw('appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,appointments.status')
            ->get();

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $all_status=['New Booking' ,'scheduled in time', 'cancelled by doctor','finished','Ready to start'];

        return view(
            'doctor.department_appointments.show_appointments',
            ['appointments' => $appointments, 'days' => $days, 'all_status'=>$all_status]
        );
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
        $appointments = DB::table('appointments')->where(['appointments.user_id' => $id, 'appointments.doctor_id' => auth()->user()->id])
            ->Join('users', 'users.id', '=', 'appointments.doctor_id')
            ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'appointments.doctor_appointment_id')
            ->Join('hours', 'hours.id', '=', 'appointments.hour_id')
            ->selectRaw('appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,appointments.status')
            ->get();

        $patient =  User::find($id);

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

        return view(
            'doctor.clinic_appointments.show_appointments',
            ['appointments' => $appointments, 'days' => $days, 'patient' => $patient]
        );
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
        $appointment= Appointment::find($id);
        $appointment->status= $request->status;
        $appointment->save();
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
