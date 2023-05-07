<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;
use App\Models\Currency;
use Carbon\Carbon;

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
        $this->authorize('viewAny', auth()->user());

        $currencies = Currency::whereDate('created_at', Carbon::today())->get();

        $data = [];

        foreach($currencies as $currency) {
            array_push($data, [
                'currency' => $currency->name,
                'date' => $currency->created_at->format('Y-m-d'),
                'amount' => $currency->amount,
            ]);
        }

        return response($data, 200);
    }

    /**
     * Return specified currency and rate from current day.
     *
     * @param Currency $currency
     * @return void
     */
    public function show(Currency $currency)
    {
        $this->authorize('view', auth()->user());

        $data = [
            'currency' => $currency->name,
            'date' => $currency->created_at->format('Y-m-d'),
            'amount' => $currency->amount,
        ];

        return response($data, 200);
    }

    /**
     * Store the Currency object in database.
     */
    public function store(CurrencyRequest $request)
    {
        $this->authorize('create', auth()->user());

        Currency::create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return response([
            'message' => __('api_response.currency.success'),
        ], 200);
    }
}
