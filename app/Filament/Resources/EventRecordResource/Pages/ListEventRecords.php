<?php

namespace App\Filament\Resources\EventRecordResource\Pages;

use App\Filament\Resources\EventRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventRecords extends ListRecords
{
    protected static string $resource = EventRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
