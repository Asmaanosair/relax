<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inside_department;
use App\Department_patient;
use App\Doctor;
use App\User;
use App\DoctorAppointment;

class Doctor_patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $appointments = DoctorAppointment::where('doctor_id',$user_id)->get();
        $user_id =auth()->user()->id;
        $doctor = Doctor::where('user_id',$user_id)->get()->first();
        $inside_department = Inside_department::where('admin_id',$doctor->id)
        ->orWhere('psychologist_id',$doctor->id)
        ->orWhere('sociologist_id',$doctor->id)
        ->orWhere('activity_executor_id',$doctor->id)
        ->orWhere('psychologist_helper_id',$doctor->id)
        ->get()->first();
        if($inside_department->count() > 0){
        $patients_id = Department_patient::where('inside_department_id',$inside_department->id)->where('patient_id','!=',null)->get();
    }  else{
        $patients_id =[];
    }

        return view('doctor.patients.index',[
            'patients_id'=>$patients_id,
            'inside_department'=>$inside_department,
            'appointments'=>$appointments
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
        $user = User::find($id);
        return view('doctor.patients.show', ['patient' => $user]);
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
        //
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
