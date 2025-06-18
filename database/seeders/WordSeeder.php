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
            $key = strrev(substr($data['word'], -3));
            \App\Models\Word::updateOrCreate(
                ['word' => $data['word']],
                $data + ['rhyme_key' => $key]
            );
        }
    }
}
