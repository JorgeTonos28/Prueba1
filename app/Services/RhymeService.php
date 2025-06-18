<?php

namespace App\Services;

use App\Models\Word;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RhymeService
{
    public function findRhymes(string $word): array
    {
        $word = Str::lower($word);
        $key = Cache::rememberForever("rhyme_key:$word", function () use ($word) {
            return Word::where('word', $word)->value('rhyme_key');
        });

        if (!$key) {
            $key = $this->computeRhymeKey($word);
        }

        $rhymes = Cache::remember("rhymes:$key", 86400, function () use ($key) {
            return Word::where('rhyme_key', $key)->orderBy('word')->pluck('word')->all();
        });

        return [
            'word' => $word,
            'rhyme_key' => $key,
            'rhymes' => $rhymes,
        ];
    }

    protected function computeRhymeKey(string $word): string
    {
        $word = Str::lower(Str::ascii($word));
        // simple heuristic: last 3 characters reversed
        return Str::reverse(Str::substr($word, -3));
    }
}
