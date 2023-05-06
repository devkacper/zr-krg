<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * Test of access user with admin role (with permission) to the currency resources.
     *
     * @return void
     */
    public function testAdminPermissionToCurrency()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'admin')
            ->get()
            ->first();

        $this->actingAs($user, 'api');

        $response = $this->get(route('currency.index'));
        $response->assertStatus(200);
    }

    /**
     * Test of access user with user role (no permission) to the currency resources.
     *
     * @return void
     */
    public function testUserPermissionToCurrency()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'user')
            ->get()
            ->first();

        $this->actingAs($user, 'api');

        $response = $this->get(route('currency.index'));
        $response->assertStatus(403);
    }
}
