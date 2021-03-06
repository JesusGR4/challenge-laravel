<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Controller where a seller is created
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){

        try{
            $request->validate([ 'name'     => 'required|string',
            ]);

            $product = new Product(['name'     => $request->name,
                'status'   => true]);

            $product->save();

            return response()->json([
                'message' => 'Successfully product created'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 401);
        }
    }

    /**
     * Controller where a product is updated
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){

        try{
            $request->validate([
                'name'       => 'string',
            ]);

            if(!$request->has('id_product')){
                return response()->json([
                    'message' => 'Id product needed'], 401);
            }

            $product = Product::find($request->id_product);
            if(!$product){
                return response()->json([
                    'message' => 'Product not found'], 401);
            }
            $product->update($request->all());

            return response()->json(['message' =>
                'Successfully product update'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }


    /**
     * Controller where a product and all related provisions are disabled
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){

        try{
            if(!$request->has('id_product')){
                return response()->json([
                    'message' => 'Id product needed'], 401);
            }
            $product = Product::find($request->id_product);
            if(!$product){
                return response()->json([
                    'message' => 'Product not found'], 401);
            }
            $product->update(['status' => false]);
            Product::disableProduct($request->id_product);
            return response()->json([
                'message' => 'Product disabled'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }
}
