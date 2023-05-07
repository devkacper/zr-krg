<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrenciesCommandTest extends TestCase
{
    /**
     * Test of command which return latest currencies rates.
     *
     * @return void
     */
    public function testCurrenciesCommandTest()
    {
        $this->artisan('currencies:rates')->assertSuccessful();
    }
}
