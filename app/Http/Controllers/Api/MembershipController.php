<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Membership;

class MembershipController extends  Controller
{
    public function index()
    {
        return response()->json([
                'status' => "Success",
                'message'=> "Returning Memberships",
                'data'   => Membership::all()
            ]);
    }
}
