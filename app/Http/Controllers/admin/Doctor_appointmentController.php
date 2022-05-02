<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DoctorAppointment;
use App\Hour;

class Doctor_appointmentController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $appointments = DoctorAppointment::where('doctor_id',$user_id)->get();
        return view('doctor.doctor_oppointments.index',['appointments'=>$appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        return view('doctor.doctor_oppointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $data['doctor_id']=auth()->user()->id;
        DoctorAppointment::create($data);
        return redirect(route('doctor.doctor_appointments.index'));
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
    
        $doctor_appointment = DoctorAppointment::find($id);
        return view('doctor.doctor_oppointments.edit',[
            'doctor_appointment'=>$doctor_appointment,
            ]);
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
        $doctor_appointment = DoctorAppointment::find($id);
        $data=$request->all();
        $data['doctor_id']=auth()->user()->id;
        $doctor_appointment->update($data);
        return redirect(route('doctor.doctor_appointments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor_appointment = DoctorAppointment::find($id);
        $doctor_appointment->delete();
        return back();
    }
}
