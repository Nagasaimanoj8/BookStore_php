<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testForgotPasswordApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" => 'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/forgotPassword',[
            'email'=>"nagasaimanoj33332gmail.com"
        ]);
        $response->assertStatus(200);
    }

    public function testResetApi()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Appilication/json',
             "Authorization" =>'Bearer  1|xuVhEU9FrlWqKLSYG6oOSy1f1ARAZsHbilWAtg3R'
            ])->json('post', '/api/reset',[
            'email'=>"nagasaimanoj33332gmail.com",
            "password"=>"Prasad@123",
            "token"=>"biefcwlxuomljbsd"
        ]);
        $response->assertStatus(200);
    }
}
