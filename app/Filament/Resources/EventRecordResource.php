<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Event;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventRecord;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EventRecordResource\Pages;
use App\Filament\Resources\EventRecordResource\RelationManagers;
use App\Filament\Resources\EventRecordResource\Pages\EditEventRecord;
use App\Filament\Resources\EventRecordResource\Pages\ListEventRecords;
use App\Filament\Resources\EventRecordResource\Pages\CreateEventRecord;

class EventRecordResource extends Resource
{
    protected static ?string $model = EventRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Catatan Event';

    protected static ?string $slug = 'event-record';

    protected static ?string $modelLabel = 'Catatan Event';

    protected static ?string $navigationGroup = 'Data Event';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $event = Event::all()->pluck('name', 'id');

        return $form
            ->schema([
                Select::make('event_id')
                    ->label('Nama Event')
                    ->options($event->sortBy('name'))
                    ->searchable()
                    ->required()
                    ->validationMessages([
                        'required' => 'Nama Event wajib diisi',
                    ]),
                TextInput::make('name')
                    ->label('Nama User')
                    ->required()
                    ->validationMessages([
                        'required' => 'Nama User wajib diisi',
                    ])
                    ->maxLength(255)
                    ->autofocus()
                    ->dehydrateStateUsing(fn(?string $state): string => ucwords(strtolower($state ?? ''))),
                Textarea::make('address')
                    ->label('Alamat')
                    ->autosize()
                    ->dehydrateStateUsing(fn(?string $state): string => ucwords(strtolower($state ?? ''))),
                TextInput::make('amount')
                    ->label('Total Uang')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->validationMessages([
                        'required' => 'Total Uang wajib diisi',
                        'minValue' => 'Total Uang tidak boleh minus',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('event.name')
                    ->label('Nama Event')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Total Uang')
                    ->money('IDR'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventRecords::route('/'),
            'create' => CreateEventRecord::route('/create'),
            'edit' => EditEventRecord::route('/{record}/edit'),
        ];
    }
}