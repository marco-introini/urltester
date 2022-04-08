<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UrlResource\Pages;
use App\Models\Certificate;
use App\Models\Url;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class UrlResource extends Resource
{
    protected static ?string $model = Url::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'Site Urls';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')->unique(ignorable: fn(?Url $record): ?Url => $record
                )->required(),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->required(),
                Forms\Components\Repeater::make('headers')->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\TextInput::make('value')->required(),
                ])->label('Header used to call the URL')
                    ->nullable(),
                Forms\Components\Textarea::make('request')
                    ->required()
                    ->label('Request to be sent to URL'),
                Forms\Components\Textarea::make('expected_response')
                    ->nullable(),
                Forms\Components\Select::make('certificate_id')
                    ->label('Certificate (optional)')
                    ->options(Certificate::all()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('certificate')
                    ->getStateUsing(function (Url $record) {
                        if (!is_null($record->certificate)) {
                            return $record->certificate->name;
                        }
                            else {
                                return "No Certificate Used";
                            }
                }),
            ])
            ->filters([
                //
            ])
            ->pushActions([
                Tables\Actions\LinkAction::make('delete')
                    ->action(fn(Url $record) => $record->delete())
                    ->requiresConfirmation()
                    ->color('danger'),
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
            'index' => Pages\ListUrls::route('/'),
            'create' => Pages\CreateUrl::route('/create'),
            'edit' => Pages\EditUrl::route('/{record}/edit'),
        ];
    }

}
