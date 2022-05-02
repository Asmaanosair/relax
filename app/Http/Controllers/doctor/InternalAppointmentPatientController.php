<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\InternalAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InternalAppointmentPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $appointments = DB::table('internal_appointments')->where(['internal_appointments.doctor_id' => auth()->user()->id])
            ->Join('users', 'users.id', '=', 'internal_appointments.user_id')
            ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'internal_appointments.doctor_appointment_id')
            ->Join('hours', 'hours.id', '=', 'internal_appointments.hour_id')
            ->selectRaw('internal_appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,internal_appointments.status')
            ->get();

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $all_status=['On Time' ,'scheduled in time', 'cancelled by doctor','finished','Ready to start'];

        return view(
            'doctor.clinic_appointments.show_appointments',
            ['appointments' => $appointments, 'days' => $days,'all_status'=>$all_status]
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
        //
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
        $appointment= InternalAppointment::find($id);
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
