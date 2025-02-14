<?php

namespace App\Filament\Resources\EventRecordResource\Pages;

use App\Filament\Resources\EventRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventRecord extends EditRecord
{
    protected static string $resource = EventRecordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}