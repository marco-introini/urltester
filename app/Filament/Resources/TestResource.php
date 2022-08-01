<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-trending-up';

    protected static ?string $navigationLabel = 'Test Results';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('url.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_date')
                    ->label('Request Timestamp')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('response_date')
                    ->label('Response Timestamp')
                    ->dateTime()
                    ->sortable()
                    ->default('N/A'),
                Tables\Columns\BadgeColumn::make('response_ok')
                    ->colors([
                        'danger' => 0,
                        'success' => 1,
                    ])
                    ->enum([
                        false => 'Failed',
                        true => 'Success',
                    ])
                    ->label('Success'),
            ])
            ->filters([
                //
            ])
            ->defaultSort('request_date', 'desc');
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
            'view' => Pages\ViewTest::route('/{record}'),
        ];
    }
}
