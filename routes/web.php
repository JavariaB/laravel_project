<?php

use App\Http\Controllers as Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return redirect('dashboard');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', [Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::get('/categories/dt', [Controllers\CategoryController::class, 'datatable'])->name('categories.dt');
    Route::resource('categories', Controllers\CategoryController::class)->except(['show']);

    Route::get('/products/dt', [Controllers\ProductController::class, 'datatable'])->name('products.dt');
    Route::resource('products', Controllers\ProductController::class)->except(['show']);

    Route::get('/language-lines/dt', [Controllers\LanguageLinesController::class, 'datatable'])->name('language-lines.dt');
    Route::resource('language-lines', Controllers\LanguageLinesController::class)->except(['show']);

    Route::get('/notifications/dt', [Controllers\NotificationController::class, 'datatable'])->name('notifications.dt');
    Route::resource('notifications', Controllers\NotificationController::class)->except(['show']);
    
    Route::get('/users/dt', [Controllers\UserController::class, 'datatable'])->name('users.dt');
    Route::resource('users', Controllers\UserController::class)->except(['show']);
    
    Route::get('/roles/dt', [Controllers\RoleController::class, 'datatable'])->name('roles.dt');
    Route::resource('roles', Controllers\RoleController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
