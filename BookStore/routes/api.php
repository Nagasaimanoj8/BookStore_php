<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserContoller;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\OrderController;
use App\Models\Wishlist;

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
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/addBook',[BookController::class,'addBook']);
    Route::post('addBookTocart',[CartController::class,'addBookTocart']);




Route::post('/updateBook',[BookController::class,'updateBook']);
Route::get('/showBooks',[BookController::class,'showBooks']);
Route::post('/delete',[BookController::class,'delete']);
Route::post('/searchBook',[BookController::class,'searchBook']);
Route::post('/updateQuantityById',[BookController::class,'updateQuantityById']);

Route::post('addBookToWishlist', [WishlistController::class, 'addBookToWishlist']);

Route::post('addAddress', [AddressController::class, 'addAddress']);
Route::get('getAllAddresses', [AddressController::class, 'getAllAddresses']);
Route::post('deleteAddress', [AddressController::class, 'deleteAddress']);
Route::post('updateAddress', [AddressController::class, 'updateAddress']);

Route::post('deleteBookFromCart',[CartController::class,'deleteBookFromCart']);
Route::get('getAllBooks',[CartController::class, 'getAllBooks']);
Route::post('updateBookInCart',[CartController::class, 'updateBookInCart']);

Route::post('/forgotPassword',[PasswordController::class,'forgotPassword']);



});
Route::post('/register', [UserContoller::class, 'register']);
Route::post('/login', [UserContoller::class, 'login']);
Route::post('updateQuantityInCart',[CartController::class,'updateQuantityInCart']);
Route::get('getAllBooksFromWishlists', [WishlistController::class, 'getAllBooksFromWishlists']);
Route::post('deleteBookFromWishlists', [WishlistController::class, 'deleteBookFromWishlists']);
Route::get('sortOnPriceLowToHigh', [BookController::class, 'sortOnPriceLowToHigh']);
Route::post('/reset',[PasswordController::class,'reset']);

Route::post('/newPassword',[PasswordController::class,'newPassword']);

Route::post('placeOrder', [OrderController::class, 'placeOrder']);
Route::post('cancelOrder',[OrderController::class,'cancelOrder']);

Route::get('sortOnPriceLowToHigh', [BookController::class, 'sortOnPriceLowToHigh']);
Route::get('sortOnPriceHighToLow', [BookController::class, 'sortOnPriceHighToLow']);






