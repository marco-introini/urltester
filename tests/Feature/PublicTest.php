<?php

it('has public page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('has GitHub link')
    ->get('/')
    ->assertSee('Github');