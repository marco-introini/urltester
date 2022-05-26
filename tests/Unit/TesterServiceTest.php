<?php

use App\Services\TesterService;
use App\Models\Url;

test('Tester is OK', function () {
    $url = Url::create([
        'name' => 'Example Url',
        'certificate_id' => null,
        'url' => 'http://www.thomas-bayer.com/axis2/services/BLZService',
        'request' => 'WRONG SOAP'
    ]);
    $testerService = new TesterService($url );

});