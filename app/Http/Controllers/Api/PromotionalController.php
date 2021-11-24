<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ItemPromotion;
use App\Models\UserPromotion;
use App\Models\PromotionsCategory;
use App\Models\PromotionsItem;
use App\Models\PromotionalHead;

class PromotionalController extends  Controller
{
    public function index(Request $request)
    {
        $session_id = $request->header('session_id');
        $user       = User::where('session_id', '=', $session_id)->first();
        if($user == null || empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404); 
        }
        
        return response()->json([
                'status' => "Success",
                'message'=> "Returning Promotions",
                'data'   => ItemPromotion::where('promotion_date', date('Y-m-d'))->whereNotIn('id', UserPromotion::where('user_id', $user->id)->pluck('item_promotion_id'))->get()
            ]);
    }
    
    public function updateStatus(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'item_promotion_id' => 'required|numeric',
            'status'            => 'required|in:accepted,rejected'
        ]);
        
        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 400);
        }
        
        $session_id = $request->header('session_id');
        $user       = User::where('session_id', '=', $session_id)->first();
        if($user == null || empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404); 
        }
        
        $item_promotion = ItemPromotion::findOrFail($request->item_promotion_id);
        
        $user_promotion = UserPromotion::firstOrNew(['item_promotion_id' => $item_promotion->id]);
        $user_promotion->user_id    = $user->id;
        $user_promotion->status     = $request->status;
        $user_promotion->save();
        
        return response()->json([
                    'status' => true,
                    'message' => 'Updated',
                    '$item_promotion' => $item_promotion
                ], 200); 
    }
    
    public function promotionalItems(Request $request)
    {
        $session_id = $request->header('session_id');
        $user       = User::where('session_id', '=', $session_id)->first();
        if($user == null || empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404); 
        }
        
        return response()->json([
                'status' => "Success",
                'message'=> "Returning Promotions",
                'data'   => PromotionsCategory::with('promotionsItems')->get(),
                'promotional_heads' => PromotionalHead::all()
            ]);
    }
}

