<?php

namespace Database\Seeders;

use App\Models\Url;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    public function run()
    {
        Url::create([
            'name' => 'Example Url',
            'certificate_id' => null,
            'url' => 'http://www.thomas-bayer.com/axis2/services/BLZService',
            'request' => 'WRONG SOAP',
        ]);
    }
}
