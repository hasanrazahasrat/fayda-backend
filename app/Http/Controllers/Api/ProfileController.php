<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
       dd($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:10',
            'email' => 'email|required',
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

        $user->update($request->all());
        
        
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Successfully update Your Profile',
            'data'      => $user
        ], 201);
    }
}
