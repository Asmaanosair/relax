<?php

namespace App\Http\Controllers\doctor;

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
        $hours=Hour::get();
        if($hours->count()==0){
           for($i=1; $i<=12 ; $i++){Hour::create(['hour'=>$i,'type'=>'AM']);} 
           for($j=1; $j<=12 ; $j++){Hour::create(['hour'=>$j,'type'=>'PM']);} 
        }

        $user_id = auth()->user()->id;
     
        $appointments = DoctorAppointment::where('doctor_id',$user_id)->get();
        return view('doctor.doctor_oppointments.index',[
            'appointments'=>$appointments,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days=['السبت','الأحد' ,'الأثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];
        $hours=Hour::get();
        return view('doctor.doctor_oppointments.create',['hours'=>$hours , 'days'=>$days]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->hours);
        $data=$request->all();
        $data['doctor_id']=auth()->user()->id;
        $doctor_appointment = DoctorAppointment::create($data);
        $doctor_appointment->hours()->attach($request->hours);
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
        $days=['السبت','الأحد' ,'الأثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];
        $doctor_appointment = DoctorAppointment::find($id);
        $hours=Hour::get();
        return view('doctor.doctor_oppointments.edit',[
            'doctor_appointment'=>$doctor_appointment,
            'hours'=>$hours,
            'days'=>$days
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
        $doctor_appointment->hours()->detach($doctor_appointment->hours);
        $doctor_appointment->hours()->attach($request->hours);
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
