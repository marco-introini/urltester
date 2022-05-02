<?php

namespace App\Filament\Pages;

use App\Models\Url;
use App\Services\TesterService;
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
        $url = Url::find($this->url);

        if (is_null($url)) {
            $this->output = "Please select an URL";
            return;
        }

        $this->output = "Executing ".$url->name."<br><br>";

        $testerService = new TesterService($url);

        $this->output .= htmlentities($testerService->executeTest());

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
