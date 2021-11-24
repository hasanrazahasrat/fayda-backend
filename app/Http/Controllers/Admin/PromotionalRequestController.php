<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromotionalRequest;
use Illuminate\Http\Request;

class PromotionalRequestController extends Controller
{
    public function index()
    {
        $promotions = PromotionalRequest::all();
        return view('admin.promotional_request.list',compact('promotions'));
    }

    public function destroy(PromotionalRequest $promotionalRequest)
    {
        
        $promotionalRequest->delete();
        return view('admin.promotional_request.list');
    }
}