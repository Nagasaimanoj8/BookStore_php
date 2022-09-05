<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'address_id',
        'cart_id',
        'cartId_json',
        'book_name',
        'book_author',
        'book_price',
        'book_quantity',
        'total_price',
        'order_id'
    ];
}
