<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Twilio\Exceptions\RestException;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

class VideoCallController extends Controller
{
    public function __construct() {
        // Twilio credentials
        $this->account_sid = 'AC41fc60e2e296b31cb480b73753164013';
        $this->auth_token = 'f3bc271dbd27b5450949b38ac4c56fa7';
        //the twilio number you purchased
        $this->from = '+1 240 883 5739';
        $this->to = '+201011837228';
        // Initialize the Programmable Voice API
        $this->client = new Client($this->account_sid, $this->auth_token);
    }

    /**
     * Making an outgoing call
     */
    public function initiateCall() {



        try {
            //Lookup phone number to make sure it is valid before initiating call
            $phone_number = $this->client->lookups->v1->phoneNumbers($this->to)->fetch();

            // If phone number is valid and exists
            if($phone_number) {
                // Initiate call and record call
                $call = $this->client->account->calls->create(
                    $this->to, // Destination phone number
                    $this->from, // Valid Twilio phone number
                    array(
                        "record" => True,
                        "url" => "http://demo.twilio.com/docs/voice.xml")
                );

                if($call) {
                    echo 'Call initiated successfully';
                } else {
                    echo 'Call failed!';
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }
    }
  public function testCall(){
      $base64Credentials = base64_encode("506fcb65ade3406ab5385399de5428fc:8cb3e5323ada4874b52ba8c3238f2eba");
      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.agora.io/dev/v1/channel/55899250c0d14742b67781cb1a14f2e5',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
              'Authorization: Basic'.$base64Credentials,

          ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      return response($response);
      //return $base64Credentials;
  }

    public function emergency(Request $request) {

    $user = $request->user();
    $socket_id = $request->socket_id;
    $channel_name = 'video-chat-development';
    $pusher = new Pusher(
        config('broadcasting.connections.pusher.key'),
        config('broadcasting.connections.pusher.secret'),
        config('broadcasting.connections.pusher.app_id'),
        [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' => true
        ]
    );
    return response(
        $pusher->presence_auth($channel_name, $socket_id, 1)
    );

}



}
