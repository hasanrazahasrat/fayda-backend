<?php

namespace App\Console\Commands;

use App\Helpers\AsarAlJawaal;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Traits\HasAsarAlJawaal;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class SyncProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:products {brand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Products from a brand';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $brand = $this->argument('brand');
        $method = "sync{$brand}Products";

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        $this->error('Invalid brand name provided');
        return 0;
    }

    public function syncAsarAlJawaalProducts()
    {
        $this->info('Syncing Asar Al Jawaal products');
        $api = new AsarAlJawaal();

        $this->info('Starting categories');
        $apiCategories = $api->getCategories();

        $this->info("Got {$apiCategories['count']} categories");
        foreach ($apiCategories['data'] as $category) {
            $info = Arr::first($category['info']['localization'] ?? [], function ($arr) {
                return $arr['language_iso'] == 'en';
            });
            $info_ar = Arr::first($category['info']['localization'] ?? [], function ($arr) {
                return $arr['language_iso'] == 'ar';
            });
            $picture = Arr::first($category['picture'] ?? [], function ($arr) {
                return $arr['picture_size'] > 200;
            });

            $object = [
                'title' => Arr::get($info, 'localization_name'),
                'title_ar' => Arr::get($info_ar, 'localization_name'),
                'points' => '20',
                'status' => 1,
                'images' => Arr::get($picture, 'picture_url'),
                'merchant_id' => '1',
                'external_id' => Arr::get($category, 'info.id')
            ];

            Category::updateOrCreate([
                'external_id' => Arr::get($category, 'info.id')
            ], $object);

            $this->info("Synced Category {$object['external_id']} -> {$object['title']}");
        }
        $this->info('Done categories');
        sleep(3);

        $this->info("Starting products");
        $apiProducts = $api->getProducts();

        $this->info("Got {$apiProducts['count']} products");
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

                $this->info("Synced Product {$object['external_id']} -> {$object['name']}");
            }
        }
        $this->info('Done products');
        return 0;
    }
}
