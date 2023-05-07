<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Models\Currency;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function __construct(CurrencyService $currencyService)
    {
        $this->middleware('auth:api');
        $this->currencyService = $currencyService;
    }

    /**
     * Return currencies rates from current day.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', auth()->user());

        $currenciesRates = $this->currencyService->getCurrenciesData();

        return response($currenciesRates, 200);
    }

    /**
     * Return specified currency and rate from current day.
     *
     * @param Currency $currency
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Currency $currency)
    {
        $this->authorize('view', auth()->user());

        $currencyRate = $this->currencyService->getCurrencyData($currency);

        return response($currencyRate, 200);
    }

    /**
     * Store the Currency object in database.
     */
    public function store(CurrencyRequest $request)
    {
        $this->authorize('create', auth()->user());

        $data = $request->safe()->only(['name', 'amount']);

        $this->currencyService->storeCurrencyData($data);

        return response([
            'message' => __('api_response.currency.success'),
        ], 200);
    }
}
