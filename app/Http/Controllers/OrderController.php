<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request){
        DB::beginTransaction();

        try {
            $orderModel = new Order();
            $requestData = $request->all();
            $data = $orderModel->createOrder($requestData);
            DB::commit();
            return response()->json($data);
        } catch (\Throwable $th) {
            DB::rollBack();
            $data = [
                $th->getFile(),
                $th->getLine(),
                $th->getMessage()
            ];

            // $data = $th;

            return response()->json($data);
        }
    }
}
