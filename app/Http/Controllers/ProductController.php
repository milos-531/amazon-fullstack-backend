<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(){
        $data = Product::all();
        return view('product',['products' => $data]);
    }

    function detail($id){
        $data = Product::find($id);
        return view('detail',['product'=>$data]);
    }

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
    
    static function cartItem(){
        $userId = Session::get('user')['id'];
        return Cart::where('user_id',$userId)->count();
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
    function orderNow(){
        $userId = Session::get('user')['id'];
        $total = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');
        return view('ordernow',['total'=>$total]); 
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
}
