<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Cart_Item;
use App\Order;
use App\Product_Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /**
     * Controller where quantity is updated.
     * If quantity is zero, row's deleted
     * If product does not exist in cart, we get best available
     * else update quantity product
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Request $request){
        try{
            $request->validate(['quantity' => 'integer|min:0']);
            $user = Auth::user();

            $cart = Cart::getCurrentCart($user->id);
            $idCart =$cart->id_cart;
            $result = Cart::checkProduct($request);
            if($result !== true){
                return $result;
            }

            $idProduct = $request->id_product;
            $quantity = $request->quantity;
            if($quantity== 0){
                $result = Cart_Item::deleteProduct($idProduct, $idCart);
                return $result;
            }

            $cartItem = $cart->cartItems()->where('id_product', $idProduct)->first();

            if(!$cartItem){
                $bestProductWithStock = Product_Seller::getBestAvailableProvision($idProduct, $quantity);
                if(!$bestProductWithStock){
                    return response()->json([
                        'message' => 'Stock not available for this product'], 401);
                }
                $cartItem = new Cart_Item(['id_cart' => $idCart,
                    'quantity' => $quantity,
                    'id_seller' => $bestProductWithStock->id_seller,
                    'id_product' => $idProduct]);
                $cartItem->save();
                return response()->json([
                    'message' => 'Itemd added to cart'], 200);

            }
            $cartItem->update(['quantity' => $quantity
            ]);
            return response()->json([
                'message' => 'Quantity updated'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 401);
        }
    }

    /**
     * Delete product from Cart
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function deleteProduct(Request $request){
        try{
            $user = Auth::user();
            $cart = Cart::getCurrentCart($user->id);
            $result = Cart::checkProduct($request);
            if($result !== true){
                return $result;
            }
            $result = Cart_Item::deleteProduct($request->id_product, $cart->id_cart);
            return $result;
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

    /**
     * Delete cart and related items
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteCart(Request $request){
        try{
            $user = Auth::user();
            $cart = Cart::getCurrentCart($user->id);
            $cart->delete();
            return response()->json([
                'message' => 'Cart deleted'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

    /**
     * Finish buy
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commitBuy(Request $request){
        try{
            $user = Auth::user();
            $idUser = $user->id;
            $cart = Cart::getCurrentCart($idUser);
            $order = new Order(['id_user' =>$idUser]);
            $order->save();

            $idOrder = $order->id_order;

            Order::insertOrderItems($idOrder, $idUser, $cart->cartItems()->get());

            // Set cart to active
            $cart->update(['status' => Cart::commited]);
            return response()->json([
                'message' => 'Order created'], 200);
        }catch (\Exception $e){
            return response()->json(['message' =>
                'We found the following error: '.$e->getMessage()], 500);
        }
    }

}
