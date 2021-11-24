<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\ItemImage;
use App\Models\Merchant;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        // $orders = Order::with('user')->with('item')->orderBy('id', 'desc')->take(10)->get();
        
        
        // return view('admin.dashboard', compact('orders'));

        
        $orders = DB::table('orders')->select('merchant_id', 'order_number') ->distinct()->get();
        $order_datas = Order::with('user')->with('item')->get();
        $merchants= Merchant::all();
        $imagelists  = ItemImage::all();

        $admins= Admin::all();

        return view('admin.dashboard', compact('orders','order_datas','merchants','imagelists','admins'));
        
       
    }
}