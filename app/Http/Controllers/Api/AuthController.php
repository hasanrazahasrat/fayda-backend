<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:10',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:8',
            'mobile' => 'required|max:11',
            'business_name' => 'required',
            'business_address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors(),
            ], 402);
        }
        $user = new User([
            'merchant_id' => '1011',
            'api_token' => Str::random(60),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'mobile' => $request->get('mobile'),
            'business_name' => $request->get('business_name'),
            'business_address' => $request->get('business_address'),
            'status' => 1,
        ]);

        $user->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully created user!',
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merchant_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors(),
            ], 402);
        }

        $user = User::where('merchant_id', $request->merchant_id)->get();


        if(!empty($user[0]->id)){
            return response()->json([
                'status' => 'success',
                'message' => 'You Have Successfully Get Session Id',
                'session_id' => $user[0]->session_id
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Exists'
            ], 401);
        }

    }
    
    public function pinVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|string',
            'code'      =>  'required|digits:4|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->errors(),
            ], 402);
        }

        $user = User::where('session_id', $request->session_id)->get();

        if(!empty($user[0]->id)){
            return response()->json([
                'status' => 'success',
                'message' => 'You Have successfully Fetch User',
                'session_id' => $user
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Exists'
            ], 401);
        }
    }


}
