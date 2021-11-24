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


class StatementController extends Controller
{

    public function index()
    {
        // $orders = Order::with('user')->get();
        $orders   = DB::table('orders')->select('merchant_id', 'order_number')->distinct()->get();
        return view('admin.statements.list',compact('orders'));
    }

    public function store(Request $request){
         // $users = Order::with('user')->get();
         // //dd($users);
        
        $orders_totals   = DB::table('orders')->select('merchant_id', 'order_number')->distinct()->get();

        $s_date = $request->starting_date;
        $e_date = $request->ending_date;

        $orders_state   = DB::table('orders')->select('merchant_id') ->distinct()->whereBetween('date', [$s_date,  $e_date])->get();
        $users          = User::get();
        $all_orders = Order::get();

        // $orders_state = DB::table('orders','user')
        //    ->whereBetween('date', [$s_date,  $e_date])
        //    ->get();
          
          $orders = DB::table('orders')->select('merchant_id', 'order_number')->distinct()->get();
           return view('admin.statements.list',compact('orders_state','orders','orders_totals','users','all_orders'));


    }
}