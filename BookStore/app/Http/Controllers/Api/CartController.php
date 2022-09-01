<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Api\BookController;

class CartController extends Controller
{
    public function addBookTocart(Request $request){
        $request->validate([
            'book_id' => 'required|integer',
            'book_quantity' => 'required|integer'
        ]);
        $cart = new Cart();
        $book = new Book();
        // $checkUser = $request->user()->id;
        // $cart->id = $checkUser;
        $checkBookId = DB::table('books')->where('id', $request->book_id)->first();

        // $checkBookInCart = DB::table('cart')->where('book_id', $request->book_id)->where('id', $checkUser)->first();
        if(!$checkBookId){
            Log::channel('custom')->error("Book already exists in cart");
            echo("Book is not available");
        }
        else{
            if($checkBookId){
                $cart->book_id = $request->input('book_id');
                $cart->book_quantity = $request->input('book_quantity');
                $cart->save();
                return response()->json(["message"=>"book added to cart successfully", "success"=>200]);
            }
            else{
                Log::channel('custom')->error("Book is not available");
                echo("Book is not available");
            }
        }      
    }
    public function deleteBookFromCart(Request $request){
        $request->validate([
            'id' => 'required|integer'
        ]);
        $response = DB::table('cart')->where('id', $request->id)->delete();
        if($response){
            return response()->json(["message"=>"Book removed from cart", "success"=>200]);
        }
        else{
            Log::channel('custom')->error("id is invalid");
        }
    }
    public function getAllBooks(Request $request){
        $cart = Cart::all();
        return $cart;
        }
        public function updateBookInCart(Request $request){
            $request->validate([
                'id' => 'required',
                'book_id' => 'required|integer',
                'book_quantity' => 'required|integer'
            ]);          
                $response = DB::table('cart')->where('id', $request->id)->update(['book_id'=>$request->book_id,  'book_quantity'=>$request->book_quantity]);
                return response()->json(["$response"=>"book updated successfully", "successstatus"=>200]);
            }
        }