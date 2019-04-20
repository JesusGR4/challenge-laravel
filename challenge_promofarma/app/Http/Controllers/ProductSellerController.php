<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_Seller;
use App\Seller;
use Illuminate\Http\Request;

class ProductSellerController extends Controller
{
    /**
     * Controller where a provision is created
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){

        $request->validate([ 'stock'     => 'required|integer|min:0',
            'amount'     => 'required|numeric|min:0.0',
            'cost'     => 'required|numeric|min:0.0',
        ]);

        if(!$request->has('id_product')){
            return response()->json([
                'message' => 'Id product needed'], 401);
        }
        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }
        if(!Product::find($request->id_product)){
            return response()->json([
                'message' => 'Product not found'], 401);
        }

        if(!Seller::find($request->id_seller)){
            return response()->json([
                'message' => 'Seller not found'], 401);
        }
        var_dump($request->all());
        die;
        $product = new Product_Seller(['stock'     => $request->stock,
            'amount' => $request->amount,
            'cost'   => $request->cost,
            'id_seller' => $request->id_seller,
            'id_product' => $request->id_product,
            'status'   => true]);

        $product->save();

        return response()->json([
            'message' => 'Successfully product created'], 200);
    }
}
