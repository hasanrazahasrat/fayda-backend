<?php


namespace App\Http\Controllers\Merchant;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\ItemImage;
use App\Models\Merchant;
use App\Models\Admin;

class OrderController
{
    public function index()
    {
    	$orders = DB::table('orders')->select('merchant_id', 'order_number') ->distinct()->get();
        $order_datas = Order::with('user')->with('item')->get();
        $merchants= Merchant::all();
        $imagelists  = ItemImage::all();

        $admins= Admin::all();

        
        return view('merchant.order.list', compact('orders','order_datas','merchants','imagelists','admins'));
    }
}
