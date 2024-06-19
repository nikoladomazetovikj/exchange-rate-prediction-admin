<?php

use App\Console\Commands\CallPredictionsApi;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CallPredictionsApi::class)->weeklyOn(1, '1:00');
