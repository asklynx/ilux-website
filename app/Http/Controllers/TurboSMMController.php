<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDO;

class TurboSMMController extends Controller
{
    private $api_url = 'https://turbosmmservices.com/api/v2';

    private $api_key = '6629537ca795c0d31f2f1bd170d6628b';

    public function services() //get services list
    {
        return $this->connect($data = [
            'key' => $this->api_key,
            'action' => 'services'
        ]);
    }

    public function balance()
    {
        return $this->connect($data = [
            'key' => $this->api_key,
            'action' => 'balance'
        ]);
    }

    public function addOrder($orderData)
    {
        return $this->connect($data = [
            'key' => $this->api_key,
            'action' => 'add'
        ]);
    }

    public function orderStatus($orderId)
    {
        return $this->connect($data = [
            'key' => $this->api_key,
            'action' => 'status',
            'order' => $orderId
        ]);
    }

    private function connect($data)
    {
        $client = new Client(['base_uri' => $this->api_url]);
        try {
            $url = $this->api_url . '?' . http_build_query($data);
            $response = Http::post($url);
            return json_decode($response, true);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo $e->getRequest()->getUri();
        }
    }
}