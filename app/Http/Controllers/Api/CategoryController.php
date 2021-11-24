<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
            return response()->json([
                'status' => 'Success',
                'message' => 'Category Fetch Successfully',
                'data' => $category
            ], 201);
    }
}
