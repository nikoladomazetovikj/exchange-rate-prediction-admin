<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/rates', [\App\Http\Controllers\Api\ExchangePredictionController::class, 'listRates']);
Route::get('/predictions', [\App\Http\Controllers\Api\ExchangePredictionController::class, 'listPredictions']);
