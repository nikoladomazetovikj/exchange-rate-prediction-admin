<?php

namespace App\Filament\Widgets;

use App\Models\Prediction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PredictionsChart extends ChartWidget
{
    protected static ?string $heading = 'Last Week Predictions';

    protected function getData(): array
    {
        $startOfPreviousWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfPreviousWeek = Carbon::now()->subWeek()->endOfWeek();

        $predictions = Prediction::whereBetween('date', [$startOfPreviousWeek, $endOfPreviousWeek])->get();

        $labels = $predictions->map(function ($rate) {
            return Carbon::parse($rate->date)->format('l');
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Predictions',
                    'data' => $predictions->pluck('rate')->toArray(),
                    'backgroundColor' => '#FFBD33',
                    'borderColor' => '#FFBD33',
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
