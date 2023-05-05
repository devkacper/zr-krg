<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    /**
     * Authorization test with correct credentials.
     *
     * @return void
     */
    public function testAuthorizationSuccess()
    {
        $user = User::find(1);

        $response = $this->post(route('authenticate'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertJson([
            'message' => __('api_response.authorization.success'),
            'api_token' => request()->token,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Authorization test with incorrect credentials.
     *
     * @return void
     */
    public function testAuthenticationFailure()
    {
        $user = User::find(1);

        $response = $this->post(route('authenticate'), [
            'email' => $user->email,
            'password' => 'wrong_password'
        ]);

        $response->assertJson([
            'message' => __('api_response.authorization.failed'),
        ]);

        $response->assertStatus(401);
    }
}
