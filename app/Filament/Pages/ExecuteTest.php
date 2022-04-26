<?php

namespace App\Filament\Pages;

use App\Models\Url;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;

class ExecuteTest extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.execute-test';

    protected static ?int $navigationSort = 3;

    public $url;

    public $output;

    public function submit()
    {
        $this->form->getState();

        ray('url',$this->url);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Select URL')
                ->columns(1)
                ->schema([
                   Select::make('url')
                        ->label('Url')
                        ->options(Url::all()->pluck('name', 'id'))
                        ->searchable(),
                ]),

        ];
    }

}
