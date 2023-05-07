<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyService
{
    /**
     * Return currencies rates data.
     *
     * @return array
     */
   public function getCurrenciesData()
   {
       $currencies = Currency::whereDate('created_at', Carbon::today())->get();

       $data = [];

       foreach($currencies as $currency) {
           array_push($data, [
               'currency' => $currency->name,
               'date' => $currency->created_at->format('Y-m-d'),
               'amount' => $currency->amount,
           ]);
       }

       return $data;
   }

    /**
     * Return data of specified currency.
     *
     * @param $currency
     * @return void
     */
   public function getCurrencyData($currency)
   {
        return $data = [
           'currency' => $currency->name,
           'date' => $currency->created_at->format('Y-m-d'),
           'amount' => $currency->amount,
       ];
   }

    /**
     * Store currency data.
     *
     * @param $data
     * @return void
     */
   public function storeCurrencyData($data)
   {
       if(!empty($data[0])) {
           foreach($data as $currency) {
               Currency::create([
                   'name' => $currency['code'],
                   'amount' => $currency['bid'],
               ]);
           }
       } else {
           Currency::create([
               'name' => $data['name'],
               'amount' => $data['amount'],
           ]);
       }
   }
}
