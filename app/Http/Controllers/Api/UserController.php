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
            'Authorization: key=AAAA_ToMx_c:APA91bGMLmv9DrA8oyq_7akZ-gOJg29G2CfAOfepGCT6TogTtyHdeZqiEGOge93uly_VWqCB3xT7TZWaPnXqZVx5421U72j-eRBnSWLs9B3XcXIWEpheEoSgVTtq1gSzSfbCB7LwmGjg',
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
