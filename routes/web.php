<?php

use App\Http\Controllers\DentistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('dentist')->name('dentist.')->group(function () {
    Route::get('/create', [DentistController::class, 'create'])->name('create');
    Route::get('/edit/{dentist}', [DentistController::class, 'edit'])->name('edit');
    Route::post('/store', [DentistController::class, 'store'])->name('store');
    Route::post('/update/{dentist}', [DentistController::class, 'update'])->name('update');
    Route::get('/destroy/{dentist}', [DentistController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
