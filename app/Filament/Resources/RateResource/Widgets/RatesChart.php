<?php

namespace App\Filament\Resources\RateResource\Widgets;

use Filament\Widgets\ChartWidget;

class RatesChart extends ChartWidget
{
    protected static ?string $heading = 'Rates';

    protected function getData(): array
    {
        return [

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
