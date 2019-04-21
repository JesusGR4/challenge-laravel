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

    /**
     * Controller where a Seller is updated
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){

        $request->validate([
            'name'       => 'string',
        ]);

        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }

        $seller = Seller::find($request->id_seller);
        if(!$seller){
            return response()->json([
                'message' => 'Seller not found'], 401);
        }
        $seller->update($request->all());

        return response()->json(['message' =>
            'Successfully user update']);
    }

    /**
     * Controller where a seller and all related provision are disabled
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        if(!$request->has('id_seller')){
            return response()->json([
                'message' => 'Id seller needed'], 401);
        }
        $idSeller = $request->id_seller;
        $seller = Seller::find($idSeller);
        if(!$seller){
            return response()->json([
                'message' => 'Seller not found'], 401);
        }
        $seller->update(['status' => Seller::disabled]);
        Seller::disableSeller($idSeller);
        return response()->json([
            'message' => 'Seller disabled'], 400);
    }

}
