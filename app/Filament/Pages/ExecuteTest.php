<?php

namespace App\Filament\Pages;

use App\Models\Url;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Illuminate\Http\Request;

class ExecuteTest extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.execute-test';

    protected static ?int $navigationSort = 3;

    public $url;

    public $output;

    public function submit(Request $request)
    {
        ray($request);
        ray()->showQueries();

        $url = Url::find($this->url);
        ray($url);

        if (is_null($url)) {
            ray("url is null. this is ".$this->url);
            return;
        }

        $this->output = "Executing ".$url->name."<br><br>test";
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Select URL')
                ->columns(1)
                ->schema([
                    Select::make('url')
                        ->label('Url')
                        ->name('url')
                        ->options(Url::all()->pluck('name', 'id'))
                        ->searchable(),
                ]),

        ];
    }

}
