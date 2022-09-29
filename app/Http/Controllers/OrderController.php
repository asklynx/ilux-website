<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Services\TurboOrderStatus;
use App\Http\Controllers\TurboSMMController;
use App\Services\TurboConnect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function process(Request $request)
    {
        try {
            $orderTotal = $this->calcPrice($request->service_name, $request->quantity);

            if (Wallet::where('user_id', Auth::user()->id)->value('balance') < $orderTotal) {
                return back()->with([
                    'status' => false,
                    'message' => 'Insufficient Balance'
                ]);
            }

            $query = array();

            foreach ($request->all() as $key => $value) {
                if ($key == 'key' || $key == 'action' || $key == 'link' || $key == 'quantity') {
                    $query[$key] = $value;
                }
            }

            $post = array_merge(array(
                'key' => env('API_KEY'),
                'action' => 'add',
                'service' => Service::where('service_name', $request->service_name)->value('turbo_service_id')
            ), $query);

            $submitOrder = new TurboConnect();
            $newOrder = $submitOrder->connect($post);

            if (array_key_exists("error", $newOrder)) {
                return back()->with([
                    'status' => false,
                    'message' => 'Failed to submit order. Please message Luxy for assistance.'
                ]);
            } else {
                //For Initial Order Status Checking
                $orderCheck = new TurboOrderStatus();

                //Create New Record to Local Orders Database
                $isInsertSuccess = Order::create([
                    'user_id' => Auth::user()->id,
                    'turbo_order_id' => $newOrder->order,
                    'turbo_service_id' => $request->service,
                    'package_name' => $request->package_name,
                    'price' => $request->price,
                    'status' => $orderCheck->orderStatus($newOrder->order)->status
                ]);
                if ($isInsertSuccess) {

                    $wallet = new WalletController();
                    $wallet->deduct(Auth::user()->id, $orderTotal);

                    return redirect('/dashboard')->with([
                        'status' => true,
                        'message' => 'Order Success!'
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Failed to record in local database :(',
                    ], 500);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

   public function calcPriceFb()
    {

        $data = DB::table('services')->where('service_name', 'LIKE', 'facebook%')->get();
            return $data;

    }

    public function calcPriceIg()
    {

        $data = DB::table('services')->where('service_name', 'LIKE', 'ig%')->get();
            return $data;

    }

    public function calcPriceTiktok()
    {

        $data = DB::table('services')->where('service_name', 'LIKE', 'tiktok%')->get();
            return $data;

    }

    public function calcPriceTwitter()
    {

        $data = DB::table('services')->where('service_name', 'LIKE', 'twitter%')->get();
            return $data;

    }

    public function calcPriceYt()
    {

        $data = DB::table('services')->where('service_name', 'LIKE', 'youtube%')->get();
            return $data;

    }

    public function showUserOrders()
    {
        try {
            $query = Order::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
            return $query;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
