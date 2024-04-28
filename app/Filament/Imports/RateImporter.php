<?php

namespace App\Filament\Imports;

use App\Models\Rate;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Log;

class RateImporter extends Importer
{
    protected static ?string $model = Rate::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('rate')
                ->requiredMapping()
                ->numeric()
                ->rules(['required']),
            ImportColumn::make('date')
                ->requiredMapping()
                ->rules(['required', 'date', 'date_format:Y-m-d']),
        ];
    }

    public function resolveRecord(): ?Rate
    {

         return Rate::create([
             'date' => $this->data['date'],
             'rate' => $this->data['rate']
         ]);

    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your rate import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
