<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanRegister(){
        $response = $this->json('POST', '/api/register',[
            'first_name' => 'manoj',
            'last_name' => 'rp',
            'email' => 'nagasaimanoj3338@gmail.com',
            'phone_no' => '7489656856',
            'password' => 'Ashrithap@8',
            'role' => 'Admin'
        ]);
        $response->assertStatus(200);
    }
    public function testUserCanLogin(){
        $response = $this->json('POST', '/api/login',[
            'email' => 'nagasaimanoj3338@gmail.com',
            'password' => 'Ashrithap@8',
        ]);
        $response->assertStatus(200);
    }

   

}
