<?php

namespace App\Filament\Resources\EventRecordResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use EightyNine\ExcelImport\SampleExcelExport;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\EventRecordResource;

class ListEventRecords extends ListRecords
{
    protected static string $resource = EventRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
                ->validateUsing([
                    'event_id' => 'required',
                    'name' => 'required',
                    'amount' => 'numeric|required',
                ])
                ->uploadField(
                    fn($upload) => $upload
                        ->label("File Excel")
                )
                ->color("info"),
        ];
    }
}