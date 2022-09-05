<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function successfulAddBookTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('POST', '/api/addBook',[
            'name' => 'manoj',
            'description' => 'sdiiss',
            'author' => 'janasds', 
            'price' => 114, 
            'quantity' => 1,
            'image' => 'colors.PNG'
        ]);
        $response->assertStatus(200);
    }

    public function testShowBooksApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('get', '/api/showBooks',[
            
        ]);
        // echo $response;
        $response->assertStatus(200);
    }

    public function testDeleteBookApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/delete',[
            'id'=>1
        ]);
        $response->assertStatus(200);
    }

    public function testSearchBookApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('get', '/api/searchBook',[
            'value'=>"manoj"
        ]);
        $response->assertStatus(405);
    }

    public function testSortOnPriceLowToHigh()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            // "Authorization" => 'Bearer 16|5nfHwsiyNQH9lHbboBMN8RTuZ76kFvGmvocQl9CP'
            ])->json('get', '/api/sortOnPriceLowToHigh',[
            
        ]);
        $response->assertStatus(200);
    }

    public function testSortOnPriceHighToLow()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            // "Authorization" => 'Bearer 16|5nfHwsiyNQH9lHbboBMN8RTuZ76kFvGmvocQl9CP'
            ])->json('get', '/api/sortOnPriceHighToLow',[
            
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateQuantityById()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" =>'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/updateQuantityById',[
            'id'=>2,
            'quantity'=>20
        ]);
        $response->assertStatus(200);
    }
}
