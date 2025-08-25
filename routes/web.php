<?php

use App\Http\Controllers\LocalPersonSearchController;
use App\Http\Controllers\PersonSearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route to display the search form
Route::middleware(['auth'])->get('/search', [LocalPersonSearchController::class, 'showSearchForm'])->name('person.search.form');

// Route to handle search requests
Route::middleware(['auth'])->get('/search/results', [LocalPersonSearchController::class, 'search'])->name('person.search');

// Route to export selected rows
Route::middleware(['auth'])->post('/search/export', [LocalPersonSearchController::class, 'exportSelected'])->name('person.search.export');


// Route::middleware(['auth',])->group(function () {
//     Route::get('searchlogs', [SearchLogController::class, 'index'])->name('searchlogs.index');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('searchlogs', [SearchLogController::class, 'index'])->name('searchlogs.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
