<?php

namespace App\Filament\Resources\RateResource\Pages;

use App\Filament\Imports\RateImporter;
use App\Filament\Resources\RateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRate extends CreateRecord
{
    protected static string $resource = RateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(RateImporter::class),
        ];
    }
}
