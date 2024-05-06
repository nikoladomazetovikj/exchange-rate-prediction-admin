<?php

namespace App\Http\Controllers\Api;

use App\Filament\Resources\RateResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatesResource;
use App\Models\Prediction;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExchangePredictionController extends Controller
{
    public function listRates(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $monday = Carbon::now()->startOfWeek()->subWeek()->format('Y-m-d');
        $sunday = Carbon::now()->endOfWeek()->subWeek()->format('Y-m-d');

        $rates = Rate::whereBetween('date', [$monday, $sunday])->get();

        return RatesResource::collection($rates);
    }

    public function listPredictions(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $monday = Carbon::now()->startOfWeek()->format('Y-m-d');
        $sunday = Carbon::now()->endOfWeek()->format('Y-m-d');

        $rates = Prediction::whereBetween('date', [$monday, $sunday])->get();

        return RatesResource::collection($rates);
    }
}
