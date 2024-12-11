<?php

use App\Livewire\Product;
use Livewire\Livewire;

it('displays all products', function () {
    \App\Models\Product::factory(10)->create();

    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertSee(\App\Models\Product::first()->name);
});