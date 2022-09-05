<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPlaceOrderApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
            // "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/placeOrder',[
                'cartId_json' => [3,4],
                'address_id' => 2
        ]);
        $response->assertStatus(500);
    }

    public function testCancelOrderApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             //"Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/cancelOrder',[
                'order_id'=>'WxChArEsLQ'
        ]);
        $response->assertStatus(200);
    }

}
