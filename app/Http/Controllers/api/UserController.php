<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Patient;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => 'user not found',

                ], 404);
            }
        } catch (JWTException $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getStatusCode()],

            ], 500);

        }

        return response()->json([
            'code' => '1',
            'status' => 'success',
            'data' =>$token ,
        ], 201);
    }
    public function register(Request $request)
{
    $validation = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'gender' => 'required|string|max:20',
        'birthday' => 'required|string|max:20',
        'email' => 'required|string|email:rfc,dns|max:255|unique:users',
        'phone' => 'required|numeric|unique:users',
        'password' => 'string|min:8',
    ]);

    try {
        if ($validation->fails()) {
            $errors = $validation->errors();
            return response()->json([
                'code' => '0',
                'status' => 'error',
                'error_message' => $errors
            ], 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'user_role' => 2,
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
            'password' => Hash::make($request->get('password')),

        ]);

        $token = JWTAuth::fromUser($user);
        $user->makeHidden('user_role');
        return response()->json([
            'code' => '1',
            'status' => 'success',
            'data' => compact('token','user'),

        ], 201);

    } catch (\Exception $exception) {
        return response()->json([
            'code' => '0',
            'status' => 'failed',
            'data' => ['message' => $exception->getMessage()],

        ], 500);
    }
}
    public function assessment()
{
    try {
        $user=auth('api')->user()->id;
        $user = Patient::create([
            'user_id' =>$user,
            'status' => 'assessment',
        ]);


        return response()->json([
            'code' => '1',
            'status' => 'success',

        ], 201);

    } catch (\Exception $exception) {
        return response()->json([
            'code' => '0',
            'status' => 'failed',
            'data' => ['message' => $exception->getMessage()],

        ], 500);
    }
}
    public function getUser( )
    {

        try {
            $user=auth('api')->user();

                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' =>$user ,
                ], 201);

        } catch (JWTException $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getStatusCode()],

            ], 500);

        }

    }
    public function editProfile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'birthday' => 'required|string|max:20',
            'email' => 'required|string|email:rfc,dns|max:255',
            'phone' => 'required|numeric',
        ]);
        try {
           $user = auth('api')->user()->id;
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
            $user = User::find($user);
            $data = $request->except('user_role', 'password');
            $user->update($data);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }

    public function notifications(Request $request){
        try {
            $user=auth('api')->user();
            $data=[];
            foreach ($user->notifications as $not) {
                $notification=$not->data;
                $notification['user']=User::select('name','email','image','phone_number','card_number')->findOrfail($not->data['user_id']);
                array_push($data,$notification);
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user->notifications,

            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public function toUser(Request $request)
    {
        $registration_ids = array($request->token_id);
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $registration_ids,
            'notification' => array("body" => 'رساله جديده  ', "title" => "Relax",)
        );
        /*  $fields = array
          (
            //  'to' => '/topics/682',
              'notification' => array("body" => $body,)
          );*/
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key=' . "AAAAGQIx4lQ:APA91bGhr9saRvX9J5gS6fVm4N2tZN7-nsmoPsVKwsDz_zFlfnzueAxQTgcTYnFkVRLIhce0lPcgYu4VEFfHjOVbt9i-E4Bn0q_BhnYCghNUZrxb9QhdcFr8xyJoOr2FiN0z952hDfvG",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
