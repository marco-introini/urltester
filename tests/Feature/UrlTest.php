<?php

it('has url page', function () {

    login();

    $response = $this->get('/');

    $response->assertStatus(200);
});
