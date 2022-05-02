<?php

namespace App\Http\Controllers\admin;

use App\Events\StartVideoEmergency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Auth;

class VideoCallController extends Controller
{

    public function generate_token(Request $request)
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = 'AC41fc60e2e296b31cb480b73753164013';
        $apiKeySid = 'SK230d102b5040b7cb755c2c546928a6d9';
        $apiKeySecret = '4aSJGCBVuOukQzM7rqepxiN18R8JoE0f';
        $identity = 'Emergency';
        $room_name = 'EmergencyRoom';

        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity,
            $room_name
        );

        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom($room_name);
        $token->addGrant($grant);

        // Serialize the token as a JWT
        $result=[
            "identity" => $identity,
            "token"=> $token->toJWT()
        ];

        return response()->json($result);
    }


    public function callUser(Request $request)
    {
        $data['userToCall'] = $request->user_to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';
        broadcast(new StartVideoEmergency($data))->toOthers();

    }
    public function acceptCall(Request $request)
    {
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new StartVideoEmergency($data))->toOthers();
    }
}
