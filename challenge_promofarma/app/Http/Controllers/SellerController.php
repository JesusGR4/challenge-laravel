<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Controller where a seller is created
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){

        $request->validate([ 'name'     => 'required|string',
        ]);

        $user = new Seller(['name'     => $request->name,
            'status'   => true]);

        $user->save();

        return response()->json([
            'message' => 'Successfully seller created'], 200);
    }

    public function update(Request $request){

        $request->validate([
            'name'       => 'string',
        ]);

        $attrs = [];

        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }
        if($request->has('name')) $attrs['name'] = $request->input('name');
        if(empty($attrs)){
            return response()->json([
                'message' => 'Nothing to change'], 401);
        }
        $seller = Seller::find($request->id_seller);
        if(!$seller){
            return response()->json([
                'message' => 'Seller not found'], 401);
        }
        $seller->update($attrs);

        return response()->json(['message' =>
            'Successfully user update']);
    }

    public function delete(Request $request){
        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }

        $result = Seller::disableSeller($request->id_seller);
        return response()->json([
            'message' => $result['message']], $result['code']);


    }

}
