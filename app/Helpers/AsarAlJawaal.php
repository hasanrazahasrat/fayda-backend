<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AsarAlJawaal
{
    protected $baseUrl = "https://sdemo.numny.com/bankingapi/service";
    protected static $accessToken = "";
    protected $client;

    protected $headers = [
        'language' => 'en',
        'show_sensitive_data' => '1',
        'time_zone' => 'UTC +02:15',
    ];

    public function __construct($isResource = false)
    {
        $this->setClient($isResource);
        $this->authenticate();
    }

    public function getCategories()
    {
        $products = $this->getCatalog("2", 0);

        $count = Arr::get($products, 'category_total_records');
        $data = Arr::get($products, 'catalogData.category');

        return [
            'count' => $count,
            'data' => $data,
        ];
    }

    public function getProducts()
    {
        $apiProducts = (new self())->getCatalog('3');
        $apiProducts = Arr::get($apiProducts, 'catalogData.product');
        $apiVariants = (new self())->getCatalog('4');

        $variants = array_map(function ($variant) use ($apiProducts) {
            $product = Arr::first($apiProducts, function ($p) use ($variant) {
                return $p['info']['id'] == $variant['info']['product_id'];
            });
            $variant['product'] = $product;

            return $variant;
        }, Arr::get($apiVariants, 'catalogData.variants', []));

        $count = Arr::get($apiVariants, 'variant_total_records');

        return [
            'count' => $count,
            'data' => $variants,
        ];
    }

    public function getCatalog($type = "3", $page = 1)
    {
        $headers = $this->headers + [
            'source_id' => (string) Str::uuid(),
        ];

        $response = $this->client
            ->withToken(self::$accessToken)
            ->withHeaders($headers)
            ->get('/v1/catalog/inquiry', [
                "country_code" => "682",
                "currency_id" => "12",
                "store_id" => "1",
                "start_index" => $page,
                "page_size" => "999",
                "sort_flag" => "DESC",
                "sort_by" => "Creation_Date",
                "type" => $type,
            ]);

        $json = $response->json();

        return $json;
    }

    public function createOrder($cartItems, $user)
    {
        $headers = $this->headers + [
            'source_id' => (string) Str::uuid(),
        ];

        $orderObject = [
            "items" => [],
            "payment_method" => [
                "type" => 3,
                "account" => [
                    "info" => [
                        "id" => 2719,
                    ],
                ],
            ],
            "transaction" => [
                "info" => [
                    "type" => 190,
                ],
            ],
            "admin_notes" => "",
            "notes" => "",
            "validate" => 0,
        ];

        foreach ($cartItems as $cart) {
            $orderObject['items'][] = [
                "variant" => [
                    "id" => $cart->product->external_id,
                    "quantity" => $cart->quantity
                ],
                "custom_form_data" => [
                    "features" => [
                        "delivery_email" => $user->email,
                        "delivery_phone" => $user->mobile,
                    ],
                    "customer_info" => $user->name
                ]
            ];
        }

        $response = $this->client
            ->withToken(self::$accessToken)
            ->withHeaders($headers)
            ->post('/v1/order', $orderObject);

        $json = $response->body();

        logger("Asal Al Jawaal response {$json}");
    }

    protected function authenticate()
    {
        $response = $this->client->asForm()->post('/oauth/token', [
            "grant_type" => "pos_credential",
            "pos_id" => "2773",
            "pos_user_id" => "2784",
            "user_name" => "admin",
            "password" => "12%VOJm54",
            "program_id" => "2",
            "language" => "en",
        ])->json();
        if ($response) {
            self::$accessToken = $response['access_token'];
        }
    }

    protected function setClient($isResource)
    {
        $this->client = Http::baseUrl($this->baseUrl);
    }
}
