<?php

namespace Tests\Feature\Api;

use App\Models\Currency;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test of access user with admin role (with permission) to the currencies objects.
     *
     * @return void
     */
    public function testAdminPermissionToCurrencies()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'admin')
            ->get()
            ->first();

        $currencies = Currency::whereDate('created_at', Carbon::today())->get();

        $data = [];

        foreach($currencies as $currency) {
            array_push($data, [
                'currency' => $currency->name,
                'date' => $currency->created_at->format('Y-m-d'),
                'amount' => $currency->amount,
            ]);
        }

        $this->actingAs($user, 'api');

        $response = $this->get(route('currency.index'));

        $response->assertJson($data);
        $response->assertStatus(200);
    }

    /**
     * Test of access user with user role (no permission) to the currencies objects.
     *
     * @return void
     */
    public function testUserPermissionToCurrencies()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'user')
            ->get()
            ->first();

        $this->actingAs($user, 'api');

        $response = $this->get(route('currency.index'));

        $response->assertStatus(403);
    }


    /**
     * Test of return specified currency object.
     *
     * @return void
     */
    public function testReturnCurrencyObject()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'admin')
            ->get()
            ->first();

        $currency = Currency::create([
            'name' => 'PLN',
            'amount' => 4.02,
        ]);

        $this->actingAs($user,'api');

        $response = $this->get(route('currency.show', $currency->name));

        $response->assertJson([
            'currency' => $currency->name,
            'date' => $currency->created_at->format('Y-m-d'),
            'amount' => $currency->amount,
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test of store the currency object in database.
     */
    public function testStoreCurrencyObject()
    {
        $user = User::with('roles')->whereRelation('roles', 'name', '=', 'admin')
            ->get()
            ->first();

        $this->actingAs($user, 'api');

        $data = [
            'name' => 'PLN',
            'amount' => 4.02,
        ];

        $response = $this->post(route('currency.store', $data));

        $this->assertDatabaseHas('currencies', $data);

        $response->assertJson([
            'message' => __('api_response.currency.success')
        ]);
        $response->assertStatus(200);
    }
}
