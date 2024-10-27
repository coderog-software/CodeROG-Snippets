<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnippetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/snippets', [SnippetController::class, 'index'])->name('snippets.index');
Route::get('/snippet/{uid}', [SnippetController::class, 'show'])->name('snippet.show');

Route::get('/embed/{uid}', [SnippetController::class, 'embed'])->name('snippet.embed');