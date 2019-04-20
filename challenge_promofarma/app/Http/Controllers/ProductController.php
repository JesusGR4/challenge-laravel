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

        $request->validate([ 'name'     => 'required|string',
        ]);

        $product = new Product(['name'     => $request->name,
            'status'   => true]);

        $product->save();

        return response()->json([
            'message' => 'Successfully product created'], 200);
    }

    public function update(Request $request){

        $request->validate([
            'name'       => 'string',
        ]);

        $attrs = [];

        if(!$request->has('id_product')){
            return response()->json([
                'message' => 'Id product needed'], 401);
        }
        if($request->has('name')) $attrs['name'] = $request->input('name');
        if(empty($attrs)){
            return response()->json([
                'message' => 'Nothing to change'], 401);
        }
        $product = Product::find($request->id_product);
        if(!$product){
            return response()->json([
                'message' => 'Product not found'], 401);
        }
        $product->update($attrs);

        return response()->json(['message' =>
            'Successfully product update']);
    }

    public function delete(Request $request){

        if(!$request->has('id_product')){
            return response()->json([
                'message' => 'Id product needed'], 401);
        }

        $result = Product::disableProduct($request->id_product);
        return response()->json([
            'message' => $result['message']], $result['code']);
    }
}
