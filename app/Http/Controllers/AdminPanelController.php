<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class AdminPanelController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    public function displayOrders()
    {
        try {
            $query = DB::table('orders')->orderBy('updated_at', 'DESC')->get();
            return $query;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function displayWallets()
    {
        try {
            $query = DB::table('wallets')->orderBy('updated_at', 'DESC')->get();
            return $query;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function displayServices()
    {
        try {
            $query = DB::table('services')->orderBy('updated_at', 'DESC')->get();
            return $query;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function displayUsers()
    {
        try {
            $query = DB::table('users')->select('id', 'username', 'email', 'created_at', 'updated_at')->orderBy('updated_at', 'DESC')->get();
            return $query;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function findWallet(Request $request)
    {
    }

    public function createService(Request $request)
    {
        try {
            Service::create([
                'service_name' => $request->service_name,
                'service_desc' => $request->service_desc,
                'turbo_service_id' => $request->turbo_service_id,
                'price' => $request->price
            ]);

            return back()->with([
                'status' => true,
                'message' => 'Service Creation Success!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function updateTServID(Request $request)
    {
        try {
            Service::where('id', $request->id)->update(array('turbo_service_id' => $request->turbo_service_id));

            return back()->with([
                'status' => true,
                'message' => 'Turbo Service ID Updated!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function updatePrice(Request $request)
    {
        try {
            Service::where('id', $request->id)->update(array('price' => $request->price));

            return back()->with([
                'status' => true,
                'message' => 'Price Updated!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
