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

    /**
     * @test
     * Test Must Enter Email and Password
     */
    public function testMustEnterEmailAndPassword()
    {
        $body = [
            'email' => '',
            'password' => ''
        ];

        $this->json('POST','/api/auth/login',$body,['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'error' => 'This field is required.'
            ]);
    }
}
