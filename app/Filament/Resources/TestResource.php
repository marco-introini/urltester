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
    protected static ?int $navigationSort = 3;

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
                Tables\Columns\TextColumn::make('url.name'),
                Tables\Columns\BadgeColumn::make('request_date')
                    ->label('Request Timestamp'),
                Tables\Columns\BadgeColumn::make('response_date')
                    ->label('Response Timestamp'),
                Tables\Columns\BadgeColumn::make('response_ok')
                    ->colors([
                        'danger' => false,
                        'success' => true,
                        ])
                    ->label('Success'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
