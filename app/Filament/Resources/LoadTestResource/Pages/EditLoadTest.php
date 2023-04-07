<?php

namespace App\Filament\Resources\LoadTestResource\Pages;

use App\Filament\Resources\LoadTestResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLoadTest extends EditRecord
{
    protected static string $resource = LoadTestResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
