<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CountryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_country()
    {
        \App\Models\Country::create([
            'initial' => 'TE',
            'name' => 'Teste'
        ]);

        $this->assertDatabaseHas('country', ['name' => 'Teste']);
    }
}
