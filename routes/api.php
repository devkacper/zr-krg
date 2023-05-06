<?php

use App\Http\Controllers\Api\AuthorizationController;
use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('authenticate', [AuthorizationController::class, 'authenticate'])->middleware('api')->name('authenticate');

Route::apiResources([
    'currency' => CurrencyController::class,
], ['only' => 'index', 'show', 'store']);
