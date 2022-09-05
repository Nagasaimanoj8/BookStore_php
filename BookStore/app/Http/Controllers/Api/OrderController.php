<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\sendCancelledOrderDetails;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendOrderDetails;
use LengthException;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function getBookById($id){
        return DB::table('books')->where('id', $id)->first(); 
    }

    public function placeOrder(Request $request){
        $request->validate([
            'cartId_json' => 'required',
            'address_id' => 'required|integer'
        ]);
        $cartId_json = $request->cartId_json;
        $length = sizeof($cartId_json);
       
        // return $length;
        for($i=0; $i < $length; $i++){
           
            $cart = DB::table('cart')->where('id', $cartId_json[$i])->first();
    
            $book = $this->getBookById($cart->book_id);
            $order = new Order();
        
            $order->cartId_json = $cartId_json[$i];
            $order->cart_id = $cartId_json[$i];
            $order->address_id = $request->input('address_id');
            $order->book_name = $book->name;
            $order->book_author = $book->author;
            $order->book_price = $book->price;
            $order->book_quantity = $cart->book_quantity;
            $order->total_price = $cart->book_quantity * $book->price;
            $randomCode = Str::random(10);
            $order->order_id = $randomCode;
            $order->save();
    
            
        }
        Log::channel('custom')->debug("Order Placed successfully");
        return response()->json(["message"=>"order placed successfully", "successStatus"=>200]);
    }

    public function cancelOrder(Request $request){
        $request->validate([
            'order_id' => 'required|string',
            
        ]);
        $getUser = $request->user();
        $order = DB::table('orders')->where('order_id', $request->order_id)->first();
        $response = DB::table('orders')->where('order_id', $request->order_id)->delete();
        return response()->json(["message"=>"Order cancelled"]);
        Log::channel('custom')->debug("Order Cancelled");
    }
}