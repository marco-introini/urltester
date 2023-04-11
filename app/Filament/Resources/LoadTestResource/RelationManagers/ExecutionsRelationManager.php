<?php

namespace App\Filament\Resources\LoadTestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExecutionsRelationManager extends RelationManager
{
    protected static string $relationship = 'executions';

    protected static ?string $recordTitleAttribute = 'executed_at';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('executed_at')
                    ->required()
                    ->maxLength(255),

                TextInput::make('number_requests_effective')
                    ->label('Effective number of requests done')
                    ->integer()->disabled()->visibleOn('edit'),

                TextInput::make('success_number')
                    ->label('Number of success requests')
                    ->integer()->disabled()->visibleOn('edit'),

                TextInput::make('failure_number')
                    ->label('Number of failed requests')
                    ->integer()->disabled()->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('executed_at'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
