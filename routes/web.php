<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PermissionsController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UserProfileController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Cache;
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

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('dashboard');

/**
 * Dashboard
 */
Route::prefix('dashboard')->middleware('auth:web')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::any('/ajax', [AdminController::class, 'ajax'])->name('ajax');
    });

    Route::prefix('roles')->name('role.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        Route::any('/ajax', [RoleController::class, 'ajax'])->name('ajax');
    });

    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/', [PermissionsController::class, 'index'])->name('index');
        Route::post('/store', [PermissionsController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [PermissionsController::class, 'destroy'])->name('destroy');
        Route::any('/ajax', [PermissionsController::class, 'ajax'])->name('ajax');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::any('/ajax', [UserController::class, 'ajax'])->name('ajax');

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [UserProfileController::class, 'index'])->name('index');
            Route::any('/ajax', [UserProfileController::class, 'ajax'])->name('ajax');
        });
    });

});

/**
 * localize language
 */
Route::get('/js/lang.js', function () {
    $strings = Cache::rememberForever('lang.js', function () {
        $lang = config('app.locale');

        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings, JSON_UNESCAPED_UNICODE) . ';');
    exit();
})->name('asset.lang');
Route::get('/test', function () {
//    $user = \App\Models\Admins::find(1);
//    $user->update([
//        'password' => Hash::make('demo')
//    ]);
});
