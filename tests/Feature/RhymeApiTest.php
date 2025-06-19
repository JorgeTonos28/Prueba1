<?php

namespace Tests\Feature;

use App\Services\RhymeService;
use Database\Seeders\WordSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RhymeApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(WordSeeder::class);
    }

    public function test_rhymes_endpoint_returns_data(): void
    {
        $response = $this->getJson('/api/rhymes?word=canci%C3%B3n');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'word',
                'rhyme_key',
                'rhymes',
            ])
            ->assertJson([
                'word' => 'cancion',
                'rhyme_key' => 'noic',
            ]);
    }
}
