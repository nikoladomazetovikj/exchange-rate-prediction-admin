<?php

namespace App\Filament\Resources\RateResource\Widgets;

use Filament\Widgets\ChartWidget;

class RatesChart extends ChartWidget
{
    protected static ?string $heading = 'Rates';

    public ?string $filter = 'this_week';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Real Rates',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'this_week' => 'This Week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
