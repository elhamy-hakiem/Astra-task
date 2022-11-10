<?php
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Start Categories routes
    Route::resource('categories', CategoriesController::class);
    Route::get('/categories/edit/{id}', [CategoriesController::class ,'edit']);
    Route::post('/categories/update', [CategoriesController::class ,'update']);
    Route::get('/categories/destroy/{id}', [CategoriesController::class ,'destroy']);
    Route::get('/categories/show/{id}', [CategoriesController::class ,'show']);

    // Start Sub Categories routes
    Route::resource('subCategories', SubCategoriesController::class);
    Route::get('/subCategories/edit/{id}', [SubCategoriesController::class ,'edit']);
    Route::post('/subCategories/update', [SubCategoriesController::class ,'update']);
    Route::get('/subCategories/destroy/{id}', [SubCategoriesController::class ,'destroy']);
    Route::get('/subCategories/show/{id}', [SubCategoriesController::class ,'show']);
});
