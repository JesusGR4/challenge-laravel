<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Get orders by user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrders(Request $request){
        try{
            $data = Order::getOrders();
            return response()->json(['data' =>
                $data], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

    /**
     * Get money spent by User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSpentMoney(Request $request){
        try{
            $data = Order::getMoneySpent();
            return response()->json(['data' =>
                $data], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

}
