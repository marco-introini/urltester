<?php

namespace App\Console\Commands;

use App\Models\Url;
use App\Services\UrlTester;
use Illuminate\Console\Command;

class ExecuteTestsCommand extends Command
{
    protected $signature = 'urltester:execute';

    protected $description = 'Execute every test inside the test database table';

    public function handle()
    {
        foreach (Url::all() as $url) {
            echo 'Executing '.$url->name.PHP_EOL;
            (new UrlTester($url))->executeTest();
        }
    }
}
