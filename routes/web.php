<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

// Route::get('/', function () {
//     return view('layouts.master');
// });

// Route::get('/dashboard1', function () {
//     return view('admin.dashboard.index');
// });

Route::get('/client', [ClientController::class, 'index'])->name('index');
Route::post('/client/submit', [ClientController::class, 'create'])->name('create');
Route::get('/show/client', [ClientController::class, 'show']);
Route::get('/edit/client/{id}', [ClientController::class, 'edit']);
Route::put('/client/update', [ClientController::class, 'update']);
Route::get('/delete/{id}', [ClientController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

