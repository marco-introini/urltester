<?php

namespace App\Filament\Resources\LoadTestResource\Pages;

use App\Filament\Resources\LoadTestResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLoadTests extends ListRecords
{
    protected static string $resource = LoadTestResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
