<?php

namespace App\Filament\Resources\RateResource\Widgets;

use App\Models\Rate;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RatesChart extends ChartWidget
{
    protected static ?string $heading = 'Last Week Rates';

    protected function getData(): array
    {
        $startOfPreviousWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfPreviousWeek = Carbon::now()->subWeek()->endOfWeek();

        $rates = Rate::whereBetween('date', [$startOfPreviousWeek, $endOfPreviousWeek])->get();

        $labels = $rates->map(function ($rate) {
            return Carbon::parse($rate->date)->format('l');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Real Rates',
                    'data' => $rates->pluck('rate')->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
