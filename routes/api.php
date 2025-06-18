<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RhymeController;

Route::get('/rhymes', RhymeController::class)->middleware('throttle:60,1');
