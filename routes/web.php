<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/lang/{locale}', LocaleController::class)
    ->where(['name', 'en|ar'])
    ->name('lang');

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/relax-pricing', 'admin\PricingController@pricing');

//Route::get('/access_token', 'admin\VideoCallController@generate_token');
//Route::get('/video', function () {
//    return view('welcome');
//});

//
// //Endpoints to alert call or receive call.



Route::post('/video/accept-call', 'admin\VideoCallController@acceptCall');
//=============================== Doctor Inside Departments ================================

Route::namespace('doctor')->prefix('department-doctor')->middleware(['auth', 'inside_doctor'])->name('doctor.')->group(function () {
    Route::resource('doctor_patients', 'Doctor_patientController'); //inside department patients
    Route::resource('treatment_plans', 'Treatment_planController');
    Route::resource('internal_appointment_patients', 'InternalAppointmentPatientController');
    Route::get('/dr-video', function () {
        $users = User::where('id', 3)->get();
        return view('dr_video', ['users' => $users]);
    });
    //================================ Steps for Sessions====================================
    Route::resource('treatment_goals', 'Treatment_goalController');
    Route::get('/schools/{patient_id}', 'SchoolController@index')->name('schools.patient');
    Route::get('/schools-treatments/{school_id}/{patient_id}', 'SchoolController@show')->name('schools.treatment');
    Route::get('/schools-sessions/{treatment_id}/{patient_id}', 'SchoolController@session')->name('schools.session');
    Route::post('/schools-sessions-store', 'SchoolController@storeSession')->name('session.store');
    Route::get('/schools-sessions-edit/{id}', 'SchoolController@editSession')->name('session.edit');
    Route::put('/schools-sessions-update/{id}', 'SchoolController@updateSession')->name('session.update');
    Route::get('/schools-sessions-delete/{id}', 'SchoolController@deleteSession')->name('session.delete');


});


//================================= Doctor Outside Clinics ==================================


Route::namespace('doctor')->prefix('clinic-doctor')->middleware(['auth', 'clinic_doctor'])->name('doctor.')->group(function () {
    Route::get('/chat-clinics', 'Chat_clinicController@index')->name('chat.clinics.index');
    Route::get('/chat-clicics/{id}', 'Chat_clinicController@show')->name('chat.clinics.show');
    Route::resource('appointment_patients', 'Appointment_patientController');
});

//========================================= Doctor ===========================================

Route::namespace('doctor')->prefix('doctor')->middleware(['auth'])->name('doctor.')->group(function () {
    Route::resource('doctor_appointments', 'Doctor_appointmentController');
});
//========================================= Admin ===========================================

Route::namespace('admin')->prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/show-the-doctor/{id}', 'DoctorController@showDoctor')->name('show.the.doctor');
    Route::get('/sessions-doctors', 'Inside_departmentController@sessionDoctors')->name('sessions.doctors');
    Route::get('/show-sessions-doctors/{id}', 'Inside_departmentController@showSessionsDoctors')->name('sessions.doctors.show');
    Route::resource('patients', 'PatientController');
    Route::resource('inside_departments', 'Inside_departmentController');
    Route::resource('treatments', 'TreatmentController');
    Route::resource('treatment_appointment', 'TreatmentAppointmentController');
    Route::get('/show_sessions/{id}', 'Inside_departmentController@showSessions')->name('patient.sessions');
    Route::get('/cognitive-school-treatment', 'TreatmentController@cognitive')->name('cognitive');
    Route::resource('pricings', 'PricingController');
    Route::resource('nationalities', 'NationalityController');
    Route::resource('roles', 'RoleController');
    Route::resource('doctor_clinics', 'Doctor_clinicController');
    Route::resource('doctors', 'DoctorController');
    Route::resource('activities', 'ActivityController');
    Route::resource('clinics', 'ClinicController');
    Route::resource('payment_method', 'PaymentController');
    Route::resource('schools', 'SchoolController');
    Route::resource('question', 'QuestionController');
    Route::resource('assessments', 'AssessmentController');
    Route::get('/show-assessments/{id}', 'AssessmentController@showAssessment')->name('show.assessment');
    Route::resource('categories', 'CategoryController')->only('index', 'edit', 'update');
    Route::get('/specific-department-patients/{id}', 'Inside_departmentController@specificDepartmentPatients')->name('specific.department.patients');
    Route::get('/all-department-patients', 'Inside_departmentController@allDepartmentPatients')->name('all.department.patients');
});

//========================================= chatting=====================================

Route::get('/chat', 'ChatController@index')->name('chat.index');
Route::get('/chat/{id}', 'ChatController@show')->name('chat.show');
Route::post('/chat/getChat/{id}', 'ChatController@getChat');
Route::post('/chat/sendChat', 'ChatController@sendChat');

//========================================= Patient  patient ===========================================

Route::namespace('admin')->middleware(['auth', 'patient'])->group(function () {
    Route::post('/video/call-user', 'VideoCallController@callUser');
    Route::get('/video', function () {
        // fetch all users apart from the authenticated user
        //
        // $users = User::where('id', '<>', Auth::id())->get();
        $users = User::where('id', 3)->get();

        return view('test', ['users' => $users]);
    });
});
