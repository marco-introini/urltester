<?php

namespace App\Filament\Pages;

use App\Models\Test;
use App\Models\Url;
use App\Services\UrlTester;
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

    public $status;

    public $testName;

    public function submit(Request $request)
    {
        $url = Url::find($this->url);

        if (is_null($url)) {
            $this->output = 'Please select an URL';

            return;
        }

        $this->testName = $url->name;

        $testerService = new UrlTester($url);

        $this->output = htmlentities($testerService->executeTest());

        $this->status = Test::latest('id')->first()->response_ok;
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
