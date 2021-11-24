<?php

namespace App\Console\Commands;

use App\Helpers\AsarAlJawaal;
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
        $products = $api->getProducts();

        $products = [];
        foreach (Arr::get($products, 'data', []) as $product) {
            $products[] = [
                "external_id" => $product['']
            ];
        }

        return 0;
    }
}
