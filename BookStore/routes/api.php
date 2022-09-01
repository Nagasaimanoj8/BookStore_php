<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserContoller;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CartController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [UserContoller::class, 'register']);
Route::post('/login', [UserContoller::class, 'login']);
Route::post('/newPassword',[PasswordController::class,'newPassword']);
Route::post('/addBook',[BookController::class,'addBook']);
Route::post('/updateBook',[BookController::class,'updateBook']);
Route::get('/showBooks',[BookController::class,'showBooks']);
Route::post('/delete',[BookController::class,'delete']);
Route::post('/searchBook',[BookController::class,'searchBook']);
Route::post('/updateQuantityById',[BookController::class,'updateQuantityById']);


Route::post('addBookTocart',[CartController::class,'addBookTocart']);
Route::post('deleteBookFromCart',[CartController::class,'deleteBookFromCart']);
Route::get('getAllBooks',[CartController::class, 'getAllBooks']);
Route::post('updateBookInCart',[CartController::class, 'updateBookInCart']);

