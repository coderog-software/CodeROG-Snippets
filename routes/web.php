<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\CodeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/test', [SnippetController::class, 'index'])->name('snippets.index');
Route::get('/snippets', [SnippetController::class, 'list'])->name('snippets.list');
Route::get('/snippet/create', [SnippetController::class, 'create'])->name('snippet.create');
Route::post('/snippet/store', [SnippetController::class, 'store'])->name('snippet.store');
Route::get('/snippet/{uid}', [SnippetController::class, 'show'])->name('snippet.show');
Route::get('/snippet/{uid}/edit', [SnippetController::class, 'edit'])->name('snippet.edit');
Route::post('/snippet/{uid}/update', [SnippetController::class, 'update'])->name('snippet.update');

Route::get('/embed/{uid}', [SnippetController::class, 'embed'])->name('snippet.embed');

Route::post('/code/save', [CodeController::class, 'save'])->name('code.save');

require __DIR__.'/auth.php';



