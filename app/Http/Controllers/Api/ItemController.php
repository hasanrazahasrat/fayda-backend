<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::all();
        return response()->json([
            'status' => 'Success',
            'message' => 'Item Fetch Successfully',
            'data' => $item
        ], 201);
    }
}
