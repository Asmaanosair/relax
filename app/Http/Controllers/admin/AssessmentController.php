<?php

namespace App\Http\Controllers\admin;

use App\Doctor;
use App\DoctorAppointment;
use App\Hour;
use App\Http\Controllers\Controller;
use App\InternalAppointment;
use App\Patient;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::where('status', 'assessment')->get();

        if ($patients) {
            $patient_id = $patients->first();
        } else {
            $patient_id = null;
        }
        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $doctors = Doctor::with('user')->get();
        $hours = Hour::get();
        if ($hours->count() == 0) {
            for ($i = 1; $i <= 12; $i++) {
                Hour::create(['hour' => $i, 'type' => 'AM']);
            }
            for ($j = 1; $j <= 12; $j++) {
                Hour::create(['hour' => $j, 'type' => 'PM']);
            }
        }

        $appointment_check = InternalAppointment::where('user_id', $patient_id->user_id)->get()->first();

        if ($appointment_check) {
            return view('admin.assessments.edit', [
                'appointment' =>  $appointment_check,
                'patients' => $patients,
                'patient_id' => $patient_id,
                'days' => $days,
                'doctors' => $doctors,
                'hours' => $hours
            ]);
        }

        return view('admin.assessments.index', [
            'patients' => $patients,
            'patient_id' => $patient_id,
            'days' => $days,
            'doctors' => $doctors,
            'hours' => $hours,

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
        $data = $request->all();
        $doctor_appointment =  DoctorAppointment::create($data);
        $data['doctor_appointment_id'] = $doctor_appointment->id;
        InternalAppointment::create($data);
        return redirect(route('admin.show.assessment', $request->user_id));
    }

    public function showAssessment(Request $request, $id)
    {
        $appointment = InternalAppointment::where('user_id', $id)->get()->first();
        return view('admin.assessments.show', ['appointment' => $appointment]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patients = Patient::where('status', 'assessment')->get();
        $patient_id = Patient::where('user_id', $id)->get()->first();

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $doctors = Doctor::get();
        $hours = Hour::get();
        if ($hours->count() == 0) {
            for ($i = 1; $i <= 12; $i++) {
                Hour::create(['hour' => $i, 'type' => 'AM']);
            }
            for ($j = 1; $j <= 12; $j++) {
                Hour::create(['hour' => $j, 'type' => 'PM']);
            }
        }

        $appointment_check = InternalAppointment::where('user_id', $patient_id->user_id)->get()->first();

        if ($appointment_check) {
            return view('admin.assessments.edit', [
                'appointment' =>  $appointment_check,
                'patients' => $patients,
                'patient_id' => $patient_id,
                'days' => $days,
                'doctors' => $doctors,
                'hours' => $hours
            ]);
        }


        return view('admin.assessments.index', [
            'patients' => $patients,
            'patient_id' => $patient_id,
            'days' => $days,
            'doctors' => $doctors,
            'hours' => $hours
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patients = Patient::where('status', 'assessment')->get();
        $patient_id = Patient::where('user_id', $id)->get()->first();
        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $doctors = Doctor::get();
        $hours = Hour::get();
        $appointment = InternalAppointment::where('user_id', $id)->get()->last();
        return view('admin.assessments.edit', [
            'appointment' => $appointment,
            'patients' => $patients,
            'patient_id' => $patient_id,
            'days' => $days,
            'doctors' => $doctors,
            'hours' => $hours
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
        $data = $request->all();
        $appointment = InternalAppointment::find($id);
        $doctor_appointment =  DoctorAppointment::find($appointment->doctor_appointment_id);
        $appointment->update($data);
        $doctor_appointment->update($data);
        return redirect(route('admin.show.assessment', $request->user_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = InternalAppointment::where('user_id', $id)->get()->first();
        $appointment->delete();
        return back();
    }
}
