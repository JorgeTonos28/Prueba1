<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            ['word' => 'cancion', 'syllables' => 'can-cion', 'stress_index' => 1],
            ['word' => 'pasion', 'syllables' => 'pa-sion', 'stress_index' => 1],
            ['word' => 'vision', 'syllables' => 'vi-sion', 'stress_index' => 1],
        ];

        foreach ($words as $data) {
            $parts = explode('-', $data['syllables']);
            $slice = array_slice($parts, $data['stress_index']);
            $key = implode('', array_reverse($slice));

            \App\Models\Word::updateOrCreate(
                ['word' => $data['word']],
                $data + ['rhyme_key' => strtolower($key)]
            );
        }
    }
}
