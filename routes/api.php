<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerAutologinController@index');
Route::post('register', 'api\UserController@register');
Route::post('login', 'api\UserController@login');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'api\UserController@getUser');
    Route::post('editprofile', 'api\UserController@editprofile');
    Route::post('question', 'api\QuestionController@question');
    Route::post('answer', 'api\QuestionController@answer');
    Route::post('clinic', 'api\QuestionController@clinic');
    Route::post('doctor', 'api\QuestionController@doctor');
    Route::post('search', 'api\DoctorController@search');
    Route::post('details', 'api\DoctorController@details');
    Route::post('appointment', 'api\DoctorController@appointment');
    Route::post('upcoming', 'api\AppointmentController@upcoming');
    Route::post('history', 'api\AppointmentController@history');
    Route::post('internal_appointment', 'api\AppointmentController@appointment');
    Route::post('internal_details', 'api\AppointmentController@appointmentDetails');
    Route::post('sessions', 'api\SessionController@sessions');
    Route::post('prescriptions', 'api\SessionController@prescription');
    Route::post('appointment_detail', 'api\AppointmentController@detail');
    Route::get('getAllChat', 'api\ChatController@getAllChat');
    Route::post('getChat/{doctor_id}', 'api\ChatController@getChat');
    Route::post('sendChat', 'api\ChatController@sendChat');
    Route::post('chat_doctors', 'api\ChatController@doctors');
    Route::post('voice_call', 'api\VideoCallController@initiateCall');
    Route::post('assessment', 'api\UserController@assessment');
   // Route::post('emergency', 'api\VideoCallController@emergency');
    Route::post('notifications', 'api\UserController@notifications');
    Route::post('chat_notification', 'api\UserController@toUser');
});
Route::post('call', 'api\VideoCallController@testCall');
Route::post('/chat', 'DoctorChatController@sendChat');


Route::post('emergency', 'api\VideoCallController@emergency');
