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

    Route::get('/translations/dt', [Controllers\TranslationController::class, 'datatable'])->name('translations.dt');
    Route::resource('translations', Controllers\TranslationController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
