<?php

namespace App\Http\Controllers;

use App\Product_Seller;
use Illuminate\Http\Request;

class ProductSellerController extends Controller
{
    /**
     * Controller where a provision is created
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){

        try{
            $request->validate([ 'stock'     => 'required|integer|min:0',
                'amount'     => 'required|numeric|min:0.0',
                'cost'     => 'required|numeric|min:0.0',
            ]);

            $result = Product_Seller::checkFields($request);
            if($result !== true){
                return $result;
            }
            if(Product_Seller::exists($request)){
                return response()->json([
                    'message' => 'Provision already exists, please update it'], 401);
            }
            $product = new Product_Seller(['stock'     => $request->stock,
                'amount' => $request->amount,
                'cost'   => $request->cost,
                'id_seller' => $request->id_seller,
                'id_product' => $request->id_product,
                'status'   => Product_Seller::active]);

            $product->save();

            return response()->json([
                'message' => 'Successfully product created'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }


    /**
     * Controller where a provision is updated
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){

        try{
            $request->validate([ 'stock'     => 'integer|min:0',
                'amount'     => 'numeric|min:0.0',
                'cost'     => 'numeric|min:0.0',
            ]);

            $result = Product_Seller::checkFields($request);
            if($result !== true){
                return $result;
            }
            $productSeller = Product_Seller::exists($request);
            if(!$productSeller){
                return response()->json([
                    'message' => 'Provision does not exist, please create it'], 401);
            }
            $productSeller->update($request->all());

            return response()->json(['message' =>
                'Successfully provision update'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

    /**
     * Controller where a provision is deleted
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        try{
            $productSeller = Product_Seller::exists($request);
            if(!$productSeller){
                return response()->json([
                    'message' => 'Provision does not exist, please create it'], 401);
            }
            $productSeller->update(['status' => Product_Seller::disabled]);

            return response()->json(['message' =>
                'Successfully provision deleted'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

}
