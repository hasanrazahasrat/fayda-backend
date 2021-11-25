<?php


namespace App\Http\Controllers\Merchant;

use App\Helpers\AsarAlJawaal;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use App\Models\ItemImage;
use App\Models\Merchant;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Arr;

class DashboardController
{
    public function index()
    {
        $orders = DB::table('orders')->select('merchant_id', 'order_number') ->distinct()->get();
        $order_datas = Order::with('user')->with('item')->get();
        $merchants= Merchant::all();
        $imagelists  = ItemImage::all();
        $admins= Admin::all();

        return view('merchant.dashboard', compact('orders','order_datas','merchants','imagelists','admins'));
    }

    public function test()
    {
        $api = new AsarAlJawaal();
        $apiProducts = $api->getProducts();
        $products = [];
        foreach ($apiProducts['data'] as $product) {
            $info = Arr::first($product['info']['localization'] ?? [], function ($arr) {
                return $arr['language_iso'] == 'en';
            });
            $info_ar = Arr::first($product['info']['localization'] ?? [], function ($arr) {
                return $arr['language_iso'] == 'ar';
            });
            $picture = Arr::first($product['picture'] ?? [], function ($arr) {
                return $arr['picture_size'] > 200;
            });

            $category_id = Arr::get($product, 'product.info.category_id');
            $category = Category::where('external_id', $category_id)->first();
            $object = [
                'name' => Arr::get($info, 'localization_name'),
                'name_ar' => Arr::get($info_ar, 'localization_name'),
                'details' => Arr::get($info, 'description'),
                'details_ar' => Arr::get($info_ar, 'description'),
                'price' => Arr::get($product, 'info.default_price'),
                'points' => '0',
                'status' => 1,
                'user_id' => 1,
                'user_type' => 'merchant',
                'category_id' => $category->id ?? null,
                'merchant_id' => '1',
                'external_id' => Arr::get($product, 'info.id')
            ];

            if ($object['name'] && $object['category_id']) {
                $item = Item::updateOrCreate([
                    'external_id' => Arr::get($product, 'info.id')
                ], $object);

                ItemImage::updateOrCreate([
                    'item_id' => $item->id
                ], [
                    'item_id' => $item->id,
                    'image' => $picture['picture_url'] ?? ''
                ]);

                $products[] = $item;
            }
        }

        return $products;
    }

}
