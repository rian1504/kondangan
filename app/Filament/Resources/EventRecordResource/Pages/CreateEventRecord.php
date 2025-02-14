<?php

namespace App\Filament\Resources\EventRecordResource\Pages;

use App\Filament\Resources\EventRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventRecord extends CreateRecord
{
    protected static string $resource = EventRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}