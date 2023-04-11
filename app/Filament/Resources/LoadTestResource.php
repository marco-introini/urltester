<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoadTestResource\Pages;
use App\Models\LoadTest;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class LoadTestResource extends Resource
{
    protected static ?string $model = LoadTest::class;

    protected static ?string $slug = 'load-tests';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                Select::make('url_id')
                    ->required()
                    ->relationship('url','name'),

                TextInput::make('number_requests')
                    ->integer(),

                TextInput::make('concurrent_requests')
                    ->integer(),

                TextInput::make('number_requests_effective')
                    ->integer(),

                TextInput::make('success_number')
                    ->integer(),

                TextInput::make('failure_number')
                    ->integer(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?LoadTest $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?LoadTest $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url.name'),

                TextColumn::make('number_requests'),

                TextColumn::make('concurrent_requests'),

                TextColumn::make('number_requests_effective'),

                TextColumn::make('success_number'),

                TextColumn::make('failure_number'),

                TextColumn::make('failure_responses'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoadTests::route('/'),
            'create' => Pages\CreateLoadTest::route('/create'),
            'edit' => Pages\EditLoadTest::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}