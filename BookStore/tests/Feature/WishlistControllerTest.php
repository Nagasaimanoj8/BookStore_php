<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WishlistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddBookToWishlistApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/addBookToWishlist',[
            'cart_id'=>2,
            'book_id'=>2
        ]);
        $response->assertStatus(200);
    }

    public function testgetAllBooksFromWishlistsApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('get', '/api/getAllBooksFromWishlists',[
            // 'cart_id'=>4
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteBookFromWishlistsApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/deleteBooksFromWishlists',[
            'id'=>3
        ]);
        $response->assertStatus(404);
    }

}
