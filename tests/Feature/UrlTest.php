<?php

use App\Models\Url;
use App\Services\UrlTester;

beforeEach(function () {
    Url::create([
        'id' => 1,
        'name' => 'Example Url',
        'certificate_id' => null,
        'url' => 'http://www.thomas-bayer.com/axis2/services/BLZService',
        'request' => 'WRONG SOAP',
    ]);
});

test('Database is Created', function () {
    expect(Url::whereId(1))->not->toBeNull();
});

test('Example Url is Created', function () {
    expect(Url::whereId(1)->value('name'))->toEqual('Example Url');
});

test('Example Url Called and AxisFault returned', function () {
    $tester = new UrlTester(Url::whereId(1)->first());
    $response = $tester->executeTest();
    //ray ($response);
    expect($response)->toContain('org.apache.axis2.AxisFault');
});
