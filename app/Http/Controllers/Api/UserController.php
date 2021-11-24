<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends  Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->get();
        if (!empty($user[0]->id)) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Updated User Fetch Successfully',
                'data' => $user
            ], 201); 
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'User Not Exists',
            ], 402);
        }
    }
    
    public function sendPushNotification($token, $title, $message, $icon_lg = "", $icon_xs = "", $subtitle = "", $ticker_text = "")
    {
        // API access key from Google API's Console
        
        
        //$registrationIds = array( $_GET['id'] );
        
        // prep the bundle
        $data = array
        (
        	'message' 	=> $message,
        	'title'		=> $title,
        	'subtitle'	=> $subtitle,
        	'tickerText'	=> $ticker_text,
        	'vibrate'	=> 1,
        	'sound'		=> 1,
        	'largeIcon'	=> $icon_lg,
        	'smallIcon'	=> $icon_xs
        );
        
        $fcmEndpoint = 'https://fcm.googleapis.com/fcm/send';

        $payloads = [
            'content_available' => true,
            'priority' => 'high',
            'data' => $data,
            'notification' => ['title' => $title, 'body' => $message],
            'registration_ids' => is_array($token) ? $token : [$token]
        ];
        $headers = [
            'Authorization: key=AAAAbgmm1r0:APA91bFT6NO9cuzeWExhsCt_oTJAiGhqfs4w_g1uZ8hPyiQ2Mupnml4KDYIGvHll_LyjLRN4AbWEPjDkqieDd2KEShfiEeJN2xl3Ur_9g1KLztSDDL0vNtimtU_3QRWNJSvRh2OcUYSp',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmEndpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payloads));
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $result;
    }
}
