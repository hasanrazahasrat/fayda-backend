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
        'language'  => 'en-us',
        'show_sensitive_data' => '1',
        'time_zone' => 'UTC +02:15'
    ];

    public function __construct($isResource = false)
    {
        $this->setClient($isResource);
        $this->authenticate();
    }

    public function getCategories()
    {
        $products = $this->getCatalog("2");

        $count = Arr::get($products, 'category_total_records');
        $data = Arr::get($products, 'result_set.catalogData.product');

        return [
            'count' => $count,
            'data'  => $data
        ];
    }

    public function getProducts()
    {
        $products = $this->getCatalog();

        $count = Arr::get($products, 'product_total_records');
        $data = Arr::get($products, 'result_set.catalogData.product');

        return [
            'count' => $count,
            'data'  => $data
        ];
    }

    public function getCatalog($type = "3")
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
                "start_index" => "1",
                "page_size" => "5",
                "sort_flag" => "DESC",
                "sort_by" => "Creation_Date",
                "type" => $type
            ]);

        $json = $response->json();

        return $json;
    }

    public function createOrder()
    {
        $headers = $this->headers + [
            'source_id' => (string) Str::uuid(),
        ];

        $response = $this->client
            ->withToken(self::$accessToken)
            ->withHeaders($headers)
            ->post('/v1/order', [

            ])

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
                "language" => "en"
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
