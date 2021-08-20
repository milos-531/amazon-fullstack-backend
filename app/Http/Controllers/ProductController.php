<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    function addToCart(Request $req){

        try {
            $cart = new Cart;
            $cart->user_id = $req->user_id;
            $cart->product_id = $req->product_id;
            $cart->save();
            return $cart;
        } catch (\Throwable $th) {
                return 0;
        }

    }
    
    function cartList($userId){
       
        $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();
        return $products; 
    }
    function getProducts($top){
       
        $products = DB::table('products')->limit($top)->get();
        return $products; 
    }
    function getAllProducts($user_id){
       
        $user = User::where("id", $user_id)->first();
        if($user->role != "admin"){
            return -1;
        }
        $products = DB::table('products')->get();
        return $products; 
    }
    function getAllOrders($user_id){
       
        $user = User::where("id", $user_id)->first();
        if($user->role != "admin"){
            return -1;
        }
        $orders = DB::table('orders')
        ->join('users','orders.user_id','=','users.id')
        ->join('products','orders.product_id','=','products.id')->get();
        return $orders; 
    }
    function search($req){
        $key = strtolower($req);
        $products = DB::table('products')->whereRaw("LOWER(name) LIKE '%".$key."%'")
        ->orWhereRaw("LOWER(description) LIKE '%".$key."%'")
        ->orWhereRaw("LOWER(category) LIKE '%".$key."%'")->get();
        return $products; 
    }
    function removeCart(Request $req){
        try {
            Cart::where("user_id", $req->user_id)->where("product_id", $req->product_id)->first()->delete();
            return 1;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    function removeOrder(Request $req){
        try {
            Order::where('user_id',$req->user_id)->where('product_id',$req->product_id)->first()->delete();
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
        
    }
    function orderPlace(Request $req){

        try {
            $userId = $req->user_id;
            $allCart = Cart::where('user_id',$userId)->get();
            if(count($allCart) == 0)
                return 0;
            foreach($allCart as $cart){
    
                $order = new Order;
                $order->product_id = $cart['product_id'];
                $order->user_id = $cart['user_id'];
                $order->status = "pending";
                $order->payment_method = $req->payment;
                $order->payment_status = "pending";
                $order->address = $req->address;
                $order->save();
                Cart::where('user_id',$userId)->delete();
            }
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }

    }
    function getOrders($user_id){
        $orders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$user_id)
        ->get();
        return $orders; 
    }
    function updateOrder(Request $req){

        try {
            $order = Order::where('product_id', $req->product_id)->where('user_id',$req->user_id)->first();

            $order->payment_status = $req->payment_status;      
            $order->status = $req->status;
            if($req->status == "cancelled"){
                $order->payment_status = "cancelled";
            }   
            $order->save();

            $orders = DB::table('orders')
            ->join('users','orders.user_id','=','users.id')
            ->join('products','orders.product_id','=','products.id')->get();
            return $orders; 
        } catch (\Throwable $th) {
            return $th;
        }

    }
    function removeProduct($id){
        Product::where('id', $id)->delete();

        $products = DB::table('products')->get();
        return $products; 
    }
    function addProduct(Request $req){
        
        try {
            $existing = Product::where("name", $req->name)->first();
            if($existing){
                return -2;
            }
            $product = new Product();
            $product->name = $req->name;
            $product->category = $req->category;
            $product->description = $req->description;
            $product->price = $req->pricef;
            $product->rating = $req->rating;
            $product->image = $req->image;
    
            $product->save(); 
        } catch (\Throwable $th) {
            return -1;
        }

    }
}
