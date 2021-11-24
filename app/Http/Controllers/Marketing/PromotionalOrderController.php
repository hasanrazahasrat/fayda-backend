<?php


namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PromotionsItem;
use App\Models\PromotionsCategory;
use App\PromotionalOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\ItemImage;
use Illuminate\Support\Facades\DB;

class PromotionalOrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('promotional_orders')->select('user_id', 'order_id') ->distinct()->get();
        
        $order_datas        = PromotionalOrder::with('user')->with('promotionalorder')->get();
        //dd($order_datas);
        // $categories = PromotionsCategory::all();
        // $itemPromotions = PromotionsItem::with('PromotionsCategory')->get();
        return view('marketing.promotion-order.view', compact('orders','order_datas'));
    }
    
}