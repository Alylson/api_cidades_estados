<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * @test
     * Test Successful Login
     */
    public function testSuccessfulLogin()
    {
        $body = [
            'email' => 'admin@admin.com',
            'password' => 'desafio01'
        ];
        $this->json('POST','/api/auth/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['token_type','expires_in','access_token']);
    }
}
