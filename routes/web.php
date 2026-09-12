<?php

use App\Http\Controllers\AiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [AiController::class, 'index'])
    ->name('ai.chat');

Route::post('/ai-chat', [AiController::class, 'chat'])
    ->name('ai.chat.send');
