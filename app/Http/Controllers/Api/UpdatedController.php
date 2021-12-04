<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AsarAlJawaal;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\PromotionalOrder;
use App\Models\Item;
use App\Models\Favorite;
use App\Models\Tier;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\EarnedPoint;
use App\Models\Merchant;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UpdatedController extends Controller
{

    public function index(){

    }

    public function loginApi(Request $request){
        $validator = \Validator::make($request->all(), [
            'merchant_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $id = $request->input('merchant_id');
            $user = User::where('merchant_id', '=', $id)->first();
            if ($user === null) {
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                // $code = "1234";
                // Mail::send(['text'=>'emails.code'], ['code' => $code], function($message) use ($user){
                //     $message->to("$user->email", $user->name)
                //                 ->subject('Fayda Authentication Code');
                //     $message->from('fayda@akpharmacy.com.pk','Fayda');
                // });
                // if(!empty($user->mobile))
                // {
                //     $this->sendSMS($user->mobile, "Your security code for Fayda: " . $code);
                // }

                $user->session_id = $this->setCrypt($user->id);
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Message Send',
                    'session_id' => $user->session_id,
                    'user' => $user->only('id', 'mobile')
                ], 201);
            }
        }
    }

    public function pinVerification(Request $request){
        $validator = \Validator::make($request->all(), [
            'code' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if ($user === null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pin Code Not Valid',
                ], 404);
            }else{
                $user->device_token = $request->device_token ?: $user->device_token;
                $user->status       = true;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'User Data',
                    'session_id' => $session_id ,
                    'data' => $user
                ], 200);
            }
        }
    }

    public function updateProfile(Request $request){
        $validator = \Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'business_address' => 'required',
            'about_us'      => 'required',
            'delivery_address' => 'sometimes|nullable',
            'profile_image' => 'sometimes|nullable',
            'profile_image_ext' => 'required_with:profile_image',
            'cover_photo' => 'sometimes|nullable',
            'cover_photo_ext' => 'required_with:cover_photo',
            'device_token'  => 'sometimes|nullable',
            'business_name' => 'sometimes|nullable',
            'name'          => 'required',
            'notification_enabled' => 'sometimes|nullable|boolean'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session_id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }else{
                $path = "";
                if(!empty($request->profile_image))
                {
                    $path = "dp/" . md5($request->profile_image) . '.' . $request->profile_image_ext;
                    file_put_contents(storage_path("app/public/" . $path), base64_decode($request->profile_image));
                    // $path = $request->file('profile_image')->store('dp');
                }
                 $path2 = "";
                if(!empty($request->cover_photo))
                {
                    $path2 = "dp/" . md5($request->cover_photo) . '.' . $request->cover_photo_ext;
                    file_put_contents(storage_path("app/public/" . $path2), base64_decode($request->cover_photo));
                    // $path = $request->file('profile_image')->store('dp');
                }
                $user->name     = $request->input('name');
                $user->mobile   = $request->input('mobile');
                $user->email    = $request->input('email');
                $user->business_address = $request->input('business_address');
                $user->business_name    = $request->business_name ?: $user->business_name;
                $user->about_us         = $request->about_us;
                $user->delivery_address = $request->delivery_address ?: $user->delivery_address;
                $user->notification_enabled = $request->notification_enabled ?: $user->notification_enabled;
                if(!empty($path))
                {
                    $user->profile_image    = $path;
                }
                  if(!empty($path2))
                {
                    $user->cover_photo    = $path2;
                }
                $user->device_token     = $request->device_token ?: $user->device_token;
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'User found',
                    'session_id' => $session_id ,
                    'data' => $user
                ], 201);
            }
        }
    }

    public function getUser(Request $request){
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'User Data',
                'session_id' => $session_id ,
                'data' => $user
            ], 201);
        }
    }

    public function getEarnedPointsHistory(Request $request){
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
           $data2 = [];
            $getorder = Order::where('merchant_id' , '=', $user->id)->get();
            foreach ($getorder as $orders)
            {
                $item = Item::where('id' , '=', $orders->item_id)->get();
                $data2[] = [
                    'order' => $orders,
                    'item' => $item
                ];
            }

            return response()->json([
                'status' => true,
                'message' => 'Order Items',
                'session_id' => $session_id ,
                'data' => $data2,
                'loyalty_points' => $user->loyalty_points
            ], 201);
        }
    }

    public function getBenifits(Request $request){
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            $tiers = Tier::where('user_id', '=', $user->id)->get();
            return response()->json([
                'status' => true,
                'message' => 'Total Memberships',
                'session_id' => $session_id ,
                'data' => $tiers
            ], 201);
        }
    }

    public function getPromotionalProducts(Request $request){
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            $data2 = [];
            $category = Category::all();
            foreach ($category as $categorys)
            {
                $item = Item::where('category_id' , '=', $categorys->id)->get();
                $data2[] = [
                    'Category' => $categorys,
                    'item' => $item
                ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Promotional Product ',
                'session_id' => $session_id ,
                'data' => $data2
            ], 201);
        }
    }

    public function addtoFavorite(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $product_id = (int)$request->input('product_id');
                $user_id = $user->id;
                $checkFavorite = Favorite::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->first();
                if($checkFavorite == null){
                    $favorite = new Favorite;
                    $favorite->user_id = $user_id;
                    $favorite->product_id = $product_id;
                    $favorite->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Add To Favorite ',
                        'session_id' => $session_id ,
                        'data' => $favorite
                    ], 201);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Already Added ',
                        'session_id' => $session_id ,
                        'data' => $checkFavorite
                    ], 201);
                }
            }
        }
    }

    public function removefromFavorite(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $product_id = (int)$request->input('product_id');
                $user_id = $user->id;
                $checkFavorite = Favorite::where('user_id', '=', $user_id)->where('product_id', '=', $product_id)->first();
                if($checkFavorite == null){
                    return response()->json([
                        'status' => false,
                        'message' => 'Not Found',
                    ], 404);
                }else{
                    $checkFavorite->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Delete Favourite ',
                        'session_id' => $session_id
                    ], 201);
                }
            }
        }
    }

    public function getMerchants(Request $request)
    {
        $session_id = $request->header('session-id');
        $merchants = Merchant::where('status', 1)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Merchants',
            'session_id' => $session_id ,
            'data' => $merchants
        ], 201);
    }

    public function getDashboard(Request $request){
        $session_id = $request->header('session-id');
        $user = User::with('favorites', 'favorites.product', 'favorites.product.images')->where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            $merchantId = $request->input('merchant_id');
            $category = Category::when(!is_null($merchantId), function ($query) use ($merchantId) {
                $query->where('merchant_id', $merchantId);
            })->where('status', 1)->get();

            $special_deals = Item::with('images')->where('special_deals', '=', 1)->get();

            foreach($special_deals as &$special_deal)
            {
                if(Favorite::where('user_id', $user->id)->where('product_id', $special_deal->id)->count() > 0)
                {
                    $special_deal->is_fav = true;
                }
                else
                {
                    $special_deal->is_fav = false;
                }
            }

            $data2 = [];
            $data2[] = [
                'Category' => $category,
                'Favourite_Item' => $user->favorites,
                'special_deals' => $special_deals
            ];

            return response()->json([
                'status' => true,
                'message' => 'Dashboard',
                'session_id' => $session_id ,
                'data' => $data2
            ], 201);
        }
    }

    public function getProducts(Request $request){
        $validator = \Validator::make($request->all(), [
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $category_id = $request->input('category_id');
                $itemlist = [];
                $item = Item::with('images')->where('category_id' , '=', $category_id)->get();
                foreach ($item as $items)
                {
                    $favourite = Favorite::where('product_id', '=', $items->id)->where('user_id', '=', $user->id)->first();
                    if($favourite == null){
                        $items->is_fav = false;
                    }else{
                        $items->is_fav = true;
                    }
                    $itemlist[] = $items;
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Products list By Category',
                    'session_id' => $session_id ,
                    'data' => $itemlist
                ], 200);
            }
        }
    }



    public function addtoCart(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $cart = Cart::where('product_id', $request->input('product_id'))->where('user_id', $user->id)->first();
                if(!empty($cart))
                {
                    $cart->quantity += (int) $request->input('quantity');
                }
                else
                {
                    $cart = new Cart();
                    $cart->product_id = $request->input('product_id');
                    $cart->quantity = $request->input('quantity');
                    $cart->user_id = $user->id;
                }
                $cart->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Add to Cart',
                    'session_id' => $session_id ,
                    'data' => Cart::with('product', 'product.images')->where('user_id', $user->id)->get()
                ], 201);
            }
        }
    }

    public function updateCart(Request $request){
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $cart   = Cart::where('product_id', $request->input('product_id'))->where('user_id', $user->id)->first();
                $qty    = (int) $request->input('quantity');

                if(!empty($cart))
                {
                    if($qty <= 0)
                    {
                         $cart->delete();
                    }
                    else
                    {
                        $cart->quantity = $qty;
                        $cart->save();
                    }

                    return response()->json([
                        'status' => true,
                        'message' => 'Cart Updated',
                        'session_id' => $session_id ,
                        'data' => Cart::with('product', 'product.images')->where('user_id', $user->id)->get()
                    ], 200);
                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'No Cart Found',
                    ], 404);
                }
            }
        }
    }

    public function getCart(Request $request){
        $session_id = $request->header('session-id');

        $user = User::with('cart', 'cart.product', 'cart.product.images')->where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            $cart = Cart::where('user_id', '=', $user->id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Get Cart',
                'session_id' => $session_id ,
                'data' =>$user->cart
            ], 201);
        }
    }

    public function getRedeemHistory(Request $request){
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id)){
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }else{
            $order = Order::where('merchant_id', '=', $user->id)->get();
            return response()->json([
                'status' => true,
                'message' => 'Get Cart',
                'session_id' => $session_id ,
                'data' => $order
            ], 201);
        }
    }

    public function trackMyorder(Request $request){
        $validator = \Validator::make($request->all(), [
            'order_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else{
            $session_id = $request->header('session-id');
            $user = User::where('session_id', '=', $session_id)->first();
            if($user == null && !empty($session_id)){
                return response()->json([
                    'status' => false,
                    'message' => 'No User Found',
                ], 404);
            }else{
                $order = Order::where('merchant_id', '=', $user->id)->where('id', '=', $request->input('order_id'))->first();
                $orderStatus;
                if($order->status == 0){
                    $orderStatus = false;
                }else{
                    $orderStatus = true;
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Track Order',
                    'session_id' => $session_id ,
                    'data' => $orderStatus
                ], 201);
            }
        }
    }

    public function notifications(Request $request)
    {
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Returning Notifications',
            'notifications' => Notification::where('user_id', $user->id)->get()
        ], 200);
    }

    public function earnedPoints(Request $request)
    {
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }

         return response()->json([
                'status' => true,
                'message' => 'Returning Earned Points History',
                'data'  => EarnedPoint::where('user_id', $user->id)->get()
            ], 200);
    }

    public function buyProductsHistory(Request $request)
    {   DB::update('UPDATE orders SET  order_number = order_id');
        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }

         return response()->json([
                'status' => true,
                'message' => 'Returning Orders History',
                'data'  => Order::with('product', 'product.images')->where('merchant_id', $user->id)->get()
            ], 200);
    }


      public function AddPromotionalOrder(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_id' => 'required',

        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }
       $order_id= $request->input('order_id');
   $itemsArray= $request->input('items');


        \DB::beginTransaction();

        foreach($itemsArray as $products)
        {
            $order = new PromotionalOrder;
            $order->user_id = $user->id;
            $order->order_id     = $order_id;
            $order->item_id= $products['id'];
            $order->quantity        = $products['quantity'];

            $order->save();

        }



        \DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Promotional Order Placed',
            'data'  => []
        ], 201);
    }
    public function checkout(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
            'delivery_address' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $session_id = $request->header('session-id');
        $user = User::where('session_id', '=', $session_id)->first();
        if($user == null && !empty($session_id))
        {
            return response()->json([
                'status' => false,
                'message' => 'No User Found',
            ], 404);
        }

        $cart_products = Cart::with('product')->where('user_id', $user->id)->get();

        if($cart_products->count() == 0)
        {
            return response()->json([
                'status' => false,
                'message' => 'Cart Is Empty'
            ], 409);
        }

        $total_points = 0;

        \DB::beginTransaction();

        $externalItems = [];
        foreach($cart_products as $cart)
        {
            $order = new Order;
            $order->merchant_id = $user->id;
            $order->user_id     = $user->id;
            $order->item_id     = $cart->product_id;
            $order->order_number= $cart->quantity;
            $order->name        = $cart->product->name;
            $order->total_points= ((int) $cart->product->points) * $cart->quantity;
            $order->date        = date('Y-m-d');
            $order->status      = 0;
            $order->delivery_address = $request->delivery_address ?: "";
            $order->date        = $request->date ?: "";
            $order->time        = $request->time ?: "";
            $order->order_id        = $request->order_id ?: 00;
            $order->save();

            $total_points += $order->total_points;

            $cart->delete();

            if ($cart->product->external_id) {
                $externalItems[] = $cart;
            }
        }

        if($total_points > (int) $user->loyalty_points)
        {
            \DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'You don\'t have enough points'
            ], 409);
        }

        $user->loyalty_points = ((int) $user->loyalty_points) - $total_points;
        $user->save();

        \DB::commit();
        try {
            (new AsarAlJawaal())->createOrder($externalItems, $user);
        } catch(\Exception $e) {
            logger("Asar Al Jawaal Order Creation Error: " . $e->getMessage());
            logger($e->getTrace());
        }

        return response()->json([
            'status' => true,
            'message' => 'Order Placed',
            'data'  => Order::with('product')
                ->where('merchant_id', $user->id)
                ->latest()
                ->take($cart_products->count())
                ->get()
        ], 201);
    }

    public function setCrypt($id){
        $crypted = Crypt::encryptString($id);
        return $crypted;
    }

    public function setDecrpt($encrypt){
        try {
            $decrypted = Crypt::decryptString($encrypt);
        } catch (DecryptException $e) {
            $decrypted = 0;
        }
        return $decrypted;
    }

    //Send SMS
    private function sendSMS($phone, $message, $from = "Fayda")
    {
        $api_key    = "a4c05e77";
        $api_secret = "9i1kuAQ8V6zSFuGn";

        $curl   = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://rest.nexmo.com/sms/json",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "from=Fayda&text=" . urlencode($message) . "&to=" . $phone . "&api_key=$api_key&api_secret=$api_secret",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }
}
