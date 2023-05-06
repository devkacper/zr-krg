<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Return currencies rate from current day.
     *
     * @return void
     */
    public function index()
    {
        $this->authorize('view', auth()->user());
    }
}
