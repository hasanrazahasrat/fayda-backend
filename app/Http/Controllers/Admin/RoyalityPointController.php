<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoyalityPoint;
use Illuminate\Http\Request;

class RoyalityPointController extends Controller
{
    public function create()
    {
        $RoyalityPoint = RoyalityPoint::all();
        return view('admin.royality_points.royality_points', compact('RoyalityPoint'));
    }

    // public function store(Request $request)
    // {
    //     $request['status'] = 1;
    //     RoyalityPoint::create($request->all());
    //     return redirect()->back();
    // }
    
    public function store(Request $request, RoyalityPoint $RoyalityPoint)
    {
        $RoyalityPoint->update($request->all());
        return redirect()->route('admin.royality_points.royality_points');

    }
}
