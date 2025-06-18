<?php

namespace App\Http\Controllers;

use App\Http\Requests\RhymeRequest;
use App\Services\RhymeService;
use Illuminate\Http\JsonResponse;

class RhymeController extends Controller
{
    public function __construct(private RhymeService $service)
    {
    }

    public function __invoke(RhymeRequest $request): JsonResponse
    {
        $word = $request->validated('word');
        $data = $this->service->findRhymes($word);

        return response()->json($data);
    }
}
