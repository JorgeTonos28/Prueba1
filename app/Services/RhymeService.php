<?php

namespace App\Services;

use App\Models\Word;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RhymeService
{
    public function findRhymes(string $word): array
    {
        $normalized = Str::lower(Str::ascii($word));

        $data = Cache::remember("rhymes:$normalized", 86400, function () use ($normalized) {
            $entry = Word::where('word', $normalized)->first();
            $key = $entry?->rhyme_key ?? $this->computeRhymeKey($normalized, $entry);

            $rhymes = Word::where('rhyme_key', $key)
                ->orderBy('word')
                ->pluck('word')
                ->all();

            return [
                'word' => $normalized,
                'rhyme_key' => $key,
                'rhymes' => $rhymes,
            ];
        });

        return $data;
    }

    protected function computeRhymeKey(string $word, ?Word $entry = null): string
    {
        $entry ??= Word::where('word', $word)->first();

        if ($entry) {
            $parts = explode('-', $entry->syllables);
            $slice = array_slice($parts, $entry->stress_index);
            $joined = implode('', $slice);
            $key = Str::reverse($joined);
            return Str::lower(Str::ascii($key));
        }

        // fallback: last three letters reversed
        return Str::reverse(Str::substr($word, -3));
    }
}
