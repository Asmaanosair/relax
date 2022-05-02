<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inside_department;
use App\User;
use App\Activity;
use App\Department_patient;
use App\Role;
use App\Doctor;
use App\InternalAppointment;
use App\Patient;
use Illuminate\Support\Facades\DB;

class Inside_departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Inside_department::all();
        $inside_department_first = Inside_department::first();

        if ($inside_department_first) {
            $patients = $inside_department_first->patients;
            $inside_department_first_id =  $inside_department_first->id;
        } else {
            $patients = [];
            $inside_department_first_id = null;
        }

        $all_patients = Patient::where('status','check')->get()->count();
        $all_appointments = InternalAppointment::get()->count();

        return view('admin.inside_departments.index', [
            'departments' => $departments,
            'patients' => $patients,
            'all_patients' => $all_patients,
            'department_id' => $inside_department_first_id,
            'all_appointments' => $all_appointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients = User::with(['patient', 'insideDepartmentPatients'])->where('user_role', '2')->get();

        $doctors = $this->findOutDoctorsInsideDepartmentAndRebase(
            Doctor::with('user')->get()
        );

        $variable_activities = Activity::where('type', '1')->get();

        $permanent_activities = Activity::where('type', '0')->get();

        $role_psychologist = Role::where('role', 'الطبيب النفسى')->value('id');
        $role_psychologist_helper = Role::where('role', 'الأخصائى النفسى')->value('id');
        $role_sociologist = Role::where('role', 'الأخصائى الإجتماعى')->value('id');
        $role_activity_executor = Role::where('role', 'منفذ النشاط')->value('id');

        $psychologists = [];
        $psychologist_helpers = [];
        $sociologists = [];
        $executors = [];

        if (! is_null($role_psychologist)) {
            $psychologists = $this->filterByRole($doctors, $role_psychologist);
        }

        if (! is_null($role_psychologist_helper)) {
            $psychologist_helpers = $this->filterByRole($doctors, $role_psychologist_helper);
        }

        if (! is_null($role_sociologist)) {
            $sociologists = $this->filterByRole($doctors, $role_sociologist);
        }

        if (! is_null($role_activity_executor)) {
            $executors = $this->filterByRole($doctors, $role_activity_executor);
        }

        return view('admin.inside_departments.create', [
            'doctors' => $doctors,
            'patients' => $patients,
            'variable_activities' => $variable_activities,
            'permanent_activities' => $permanent_activities,
            'executors' => $executors,
            'sociologists' => $sociologists,
            'psychologists' => $psychologists,
            'psychologist_helpers' => $psychologist_helpers

        ]);
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
        $data['permanent_activity_id'] = implode('-', $request->permanent_activity_id);
        $data['variable_activity_id'] = implode('-', $request->variable_activity_id);
        $inside_department = Inside_department::create($data);
        $patients = $request->patients;


        for ($i = 0; $i < count($patients); $i++) {
            Department_patient::create([
                'patient_id' => $patients[$i],
                'inside_department_id' => $inside_department->id
            ]);
        }

        return redirect(route('admin.inside_departments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patients = Department_patient::where('inside_department_id', $id)->get();
        $inside_department = Inside_department::find($id);

        return view('admin.inside_departments.show', [
            'inside_department' => $inside_department,
            'patients' => $patients,


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
        $doctors = Doctor::all();
        $patients = User::where('user_role', '2')->get();

        $variable_activities = Activity::where('type', '1')->get();

        $permanent_activities = Activity::where('type', '0')->get();

        $role_psychologist = Role::where('role', 'الطبيب النفسى')->get();
        $role_psychologist_helper = Role::where('role', 'الأخصائى النفسى')->get();
        $role_sociologist = Role::where('role', 'الأخصائى الإجتماعى')->get();
        $role_activity_executor = Role::where('role', 'منفذ النشاط')->get();


        if ($role_psychologist->count() > 0) {
            $psychologists = Doctor::where('role_id',  $role_psychologist->first()->id)->get();
        } else {
            $psychologists = [];
        }

        if ($role_psychologist_helper->count() > 0) {
            $psychologist_helpers = Doctor::where('role_id',  $role_psychologist_helper->first()->id)->get();
        } else {
            $psychologist_helpers = [];
        }

        if ($role_sociologist->count() > 0) {
            $sociologists = Doctor::where('role_id',  $role_sociologist->first()->id)->get();
        } else {
            $sociologists = [];
        }

        if ($role_activity_executor->count() > 0) {
            $executors = Doctor::where('role_id',  $role_activity_executor->first()->id)->get();
        } else {
            $executors = [];
        }
        $inside_department = Inside_department::find($id);
        $selected_patients = Department_patient::where('inside_department_id', $id)->get();
        $selected_variable_activities = explode("-", $inside_department->variable_activity_id);
        $selected_permanent_activities = explode("-", $inside_department->permanent_activity_id);

        return view('admin.inside_departments.edit', [
            'doctors' => $doctors,
            'patients' => $patients,
            'selected_patients' => $selected_patients,
            'variable_activities' => $variable_activities,
            'selected_variable_activities' => $selected_variable_activities,
            'permanent_activities' => $permanent_activities,
            'selected_permanent_activities' => $selected_permanent_activities,
            'executors' => $executors,
            'sociologists' => $sociologists,
            'psychologists' => $psychologists,
            'inside_department' => $inside_department,
            'psychologist_helpers' => $psychologist_helpers

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
        $data['permanent_activity_id'] = implode('-', $request->permanent_activity_id);
        $data['variable_activity_id'] = implode('-', $request->variable_activity_id);
        $inside_department = Inside_department::find($id);



        $old_patients =  Department_patient::where([
            'inside_department_id' => $inside_department->id
        ])->get();


        for ($i = 0; $i < count($old_patients); $i++) {
            $old_patients[$i]->delete();
        }

        $patients = $request->patients;

        for ($i = 0; $i < count($patients); $i++) {
            Department_patient::create([
                'patient_id' => $patients[$i],
                'inside_department_id' => $inside_department->id
            ]);
        }

        $inside_department->update($data);

        return redirect(route('admin.inside_departments.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inside_department = Inside_department::find($id);
        $inside_department->delete();
        return back();
    }

    public function specificDepartmentPatients($id)
    {
        $all_patients = Patient::where('status','check')->get()->count();
        $departments = Inside_department::all();
        $inside_department_first = Inside_department::find($id);
        $patients =  $inside_department_first->patients;
        $all_appointments = InternalAppointment::get()->count();
        return view('admin.inside_departments.index', [
            'departments' => $departments,
            'patients' => $patients,
            'all_patients' => $all_patients,
            'department_id' => $id,
            'all_appointments' => $all_appointments
        ]);
    }

    public function allDepartmentPatients()
    {
        $all_patients = Patient::where('status','check')->get()->count();
        $departments = Inside_department::all();
        $all_appointments = InternalAppointment::get()->count();
        $patients = $patients = User::where('user_role', '2')->get();

        return view('admin.inside_departments.all_patients', [
            'departments' => $departments,
            'all_patients' => $all_patients,
            'all_appointments' => $all_appointments,
            'patients'=>$patients

        ]);
    }




    public function showSessions($id)
    {
        $sessions = DB::table('sessions')->where('sessions.user_id', $id)
            ->Join('users', 'users.id', '=', 'sessions.doctor_id')
            ->Join('treatments', 'treatments.id', '=', 'sessions.treatment_id')
            ->Join('treatment_appointments', 'treatment_appointments.id', '=', 'sessions.treatment_appointment_id')
            ->selectRaw('sessions.id,users.name,users.image,treatments.treatment,treatment_appointments.from,treatment_appointments.to,sessions.status,treatment_appointments.day , treatment_appointments.date')
            ->get();
        $patient =  User::find($id);
        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
        $all_status = ['On Time', 'scheduled in time', 'cancelled by doctor', 'finished', 'Ready to start'];
        return view(
            'admin.inside_departments.show_sessions',
            ['sessions' => $sessions, 'days' => $days, 'patient' => $patient, 'all_status' => $all_status]
        );
    }


    public function sessionDoctors()
    {

        $doctors = DB::table('internal_appointments')
            ->Join('users', 'users.id', '=', 'internal_appointments.doctor_id')
            ->selectRaw('users.id,users.name,users.image')
            ->get()->keyBy('id');;

        return view(
            'admin.all_appointments.internal_doctor',
            ['doctors' => $doctors]
        );
    }

    public function showSessionsDoctors($id)
    {
        $appointments = DB::table('internal_appointments')->where(['internal_appointments.doctor_id' => $id])
            ->Join('users', 'users.id', '=', 'internal_appointments.user_id')
            ->Join('doctor_appointments', 'doctor_appointments.id', '=', 'internal_appointments.doctor_appointment_id')
            ->Join('hours', 'hours.id', '=', 'internal_appointments.hour_id')
            ->selectRaw('internal_appointments.id,users.name,users.image,doctor_appointments.date,doctor_appointments.day,hours.hour,hours.type,internal_appointments.status')
            ->get();
        $all_status = ['On Time', 'scheduled in time', 'cancelled by doctor', 'finished', 'Ready to start'];

        $days = ['السبت', 'الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

        return view(
            'doctor.clinic_appointments.show_appointments',
            ['appointments' => $appointments, 'days' => $days, 'all_status' => $all_status]
        );
    }

    protected function filterByRole($doctors, $role_id)
    {
        return $doctors->filter(function ($doctor) use ($role_id) {
            return $doctor->role_id === $role_id;
        });
    }

    protected function findOutDoctorsInsideDepartmentAndRebase($doctors)
    {
        $ids = $doctors->pluck('id')->toArray();

        $inside = Inside_department::whereIn('admin_id', $ids)
                  ->whereIn('psychologist_id', $ids, 'or')
                  ->whereIn('sociologist_id', $ids, 'or')
                  ->whereIn('activity_executor_id', $ids, 'or')
                  ->whereIn('psychologist_helper_id', $ids, 'or')
                  ->first();

        if (is_null($inside)) {
            return ;
        }

        return $doctors->map(function ($doctor) use ($inside) {
            $id = $doctor->id;

            if (
                $id === $inside->admin_id ||
                $id === $inside->psychologist_id ||
                $id === $inside->sociologist_id ||
                $id === $inside->activity_executor_id ||
                $id === $inside->psychologist_helper_id
            ) {
                $doctor->is_inside = true;
            }

            return $doctor;
        });
    }
}
