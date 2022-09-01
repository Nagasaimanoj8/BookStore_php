<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function addBook(Request $request){
        $request->validate([
            'name' => 'required|string|min:4',
            'description' => 'required|string|min:5|max:1000',
            'author' => 'required|string', 
            'price' => 'required|integer', 
            'quantity' => 'required|integer',
            'image' => 'required',  
        ]);
        $getUser = $request->user()->id;
        $book = new Book();
        $book->user_id = $getUser;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
         $book->image = $request->image;
        $book->save();
        return response()->json(['data' => $book, 'success' => 200]);
}
 public function updateBook(Request $request){
    $request->validate([
        'id' => 'required',
        'name' => 'required|string|min:4',
        'description' => 'required|string|min:5|max:1000',
        'author' => 'required|string', 
        'price' => 'required|integer', 
        'quantity' => 'required|integer',
        'image' => 'required',  
    ]);
    $data = DB::table('books')->where('id', $request->id)->update(['name'=>$request->name, 
    'description'=>$request->description, 'author'=>$request->author, 
    'price'=>$request->price, 'quantity'=>$request->quantity, 'image'=>$request->image]);
    return response()->json(['data' ,'success' =>200]);
}
public function showBooks(){
    $books = Book::all();
    return $books;
}
public function delete(Request $request){
    $request->validate([
        'id' => 'required'
    ]);

    $response = DB::table('books')->where('id', $request->id)->delete();
    if($response){
        return $response;
    }
    else{
        Log::channel('custom')->error("You entered invalid id");
    }
}
public function searchBook(Request $request){
    $request->validate([
        'value' => 'required'
    ]);

    $data = DB::table('books')->where('name', $request->value)->
                                    orWhere('id', $request->value)->
                                    orWhere('author', $request->value)->first();
    if($data){
        return $data;
    }
    else{
       Log::channel('custom')->error("Book is not available");
       echo('Book is not available');
    }
}
public function updateQuantityById(Request $request){
    $request->validate([
        'id' => 'required',
        'quantity' => 'required'
    ]);

    $response = DB::table('books')->where('id', $request->id)->update(['quantity'=>$request->quantity]);
    if($response){
        return response()->json(["message"=>"quantity of books is updated", "sussesstoken"=>200]);
    }
    else{
        Log::channel('custom')->error("You entered invalid book id");
    }
}

}