<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\School;
use App\Session;
use App\Treatment;
use App\TreatmentAppointment;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index($patient_id)
    {
        $schools = School::all();
        return view('doctor.schools.index', [
            'patient_id' => $patient_id,
            'schools' => $schools
        ]);
    }
    public function show($school_id, $patient_id)
    {
        $treatments = Treatment::where('school_id', $school_id)->get();

        return view('doctor.schools.show_treatments', [
            'treatments' => $treatments,
            'patient_id' => $patient_id
        ]);
    }

    public function session($treatment_id, $patient_id)
    {
        $treatment = Treatment::find($treatment_id);

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

        $schools = School::all();
        return view('doctor.schools.session', [
            'schools' => $schools,
            'treatment' => $treatment,
            'patient_id' => $patient_id,
            'days' => $days
        ]);
    }


    public function storeSession(Request $request)
    {
        $data = $request->all();
        $data['doctor_id']=auth()->user()->id;
        $treatment_appointment = TreatmentAppointment::create([
            'date' => $request->date,
            'day' => $request->day,
            'from' => $request->from,
            'to' => $request->to,
            'treatment_id' => $request->treatment_id
        ]);
        $data['treatment_appointment_id'] = $treatment_appointment->id;
        Session::create($data);
        return redirect(route('doctor.treatment_plans.show', $request->user_id));
    }

    public function editSession(Request $request, $id)
    {
  
        $session = Session::find($id);
        if($session->doctor_id == auth()->user()->id){
        $schools = School::all();
        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        return view('doctor.schools.edit_session',['session'=>$session,
        'schools'=>$schools,
        'days'=>$days]);
        }else{
            return back();
        }

    }

    public function updateSession(Request $request, $id)
    {
        $session = Session::find($id);
        if($session->doctor_id ==auth()->user()->id){
        $data=$request->all();
        $data['doctor_id']=auth()->user()->id;
        $treatment_appointment=TreatmentAppointment::find($session->treatment_appointment_id);
        $treatment_appointment->update($data);
        $data['user_id']=$session->user_id;
    
        $session->update($data);
        return redirect(route('doctor.treatment_plans.show', $session->user_id));
        }else{
            return back();
        }
    }

    public function deleteSession(Request $request, $id)
    {
        $session = Session::find($id);
        $session->delete();
        return redirect(route('doctor.treatment_plans.show', $session->user_id));
    }
}
