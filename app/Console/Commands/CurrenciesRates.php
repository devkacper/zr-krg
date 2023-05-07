<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use App\Services\NBPService;
use Illuminate\Console\Command;

class CurrenciesRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return currencies rates from current day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NBPService $nbpService, CurrencyService $currencyService)
    {
        parent::__construct();
        $this->nbpService = $nbpService;
        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencies = $this->nbpService->getCurrenciesRates()[0]['rates'];

        return $this->currencyService->storeCurrencyData($currencies);
    }
}
