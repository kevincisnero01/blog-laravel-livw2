<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowPost;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard/{name?}', ShowPost::class )->name('dashboard');
});
