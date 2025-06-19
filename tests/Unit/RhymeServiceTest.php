<?php

namespace Tests\Unit;

use App\Services\RhymeService;
use Database\Seeders\WordSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RhymeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected RhymeService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new RhymeService();
        $this->seed(WordSeeder::class);
    }

    public function test_returns_rhymes_grouped_by_key(): void
    {
        $data = $this->service->findRhymes('pasion');

        $this->assertSame('sion', $data['rhyme_key']);
        $this->assertSame(['pasion', 'vision'], $data['rhymes']);
    }
}
