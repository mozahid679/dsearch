<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LocalPersonSearchController,
    PersonSearchController,
    ProfileController,
    SearchLogController
};

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

Route::middleware(['auth'])->group(function () {
    Route::get('searchlogs', [SearchLogController::class, 'index'])->name('searchlogs.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// <?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\{
//     LocalPersonSearchController,
//     PersonSearchController,
//     ProfileController,
//     SearchLogController
// };

// // Public Routes
// Route::view('/', 'welcome');
// Route::middleware(['auth', 'verified'])->view('/dashboard', 'dashboard')->name('dashboard');

// // Authenticated Routes
// Route::middleware('auth')->group(function () {

//     // Person Search
//     Route::prefix('search')->name('person.search.')->group(function () {
//         Route::get('/', [LocalPersonSearchController::class, 'showSearchForm'])->name('form');
//         Route::get('/results', [LocalPersonSearchController::class, 'search'])->name('results');
//         Route::post('/export', [LocalPersonSearchController::class, 'exportSelected'])->name('export');
//     });

//     // Search Logs
//     Route::get('/searchlogs', [SearchLogController::class, 'index'])->name('searchlogs.index');

//     // Profile Management
//     Route::prefix('profile')->name('profile.')->group(function () {
//         Route::get('/', [ProfileController::class, 'edit'])->name('edit');
//         Route::patch('/', [ProfileController::class, 'update'])->name('update');
//         Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
//     });
// });

// // Auth Routes
// require __DIR__ . '/auth.php';