<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Components\Recusive;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\SliderAdminController;
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

Route::get('/home', function () {
    return view('home');
});


Route::prefix('/admin')->group(function () {

    Route::prefix('/categories')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');

        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');


        Route::get('/edit/{id}', [CategoryController::class, 'edittool'])->name('categories.edit');

        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    });


    Route::prefix('/menus')->group(function () {

        Route::get('/', [MenuController::class, 'index'])->name('menus.index');

        Route::get('/create', [MenuController::class, 'create'])->name('menus.create');

        Route::post('/store', [MenuController::class, 'storeAdd'])->name('menus.store');

        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit');

        Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update');

        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete');
    });
    Route::prefix('/product')->group(function () {

        Route::get('/', [AdminProductController::class, 'index'])->name('product.index');

        Route::get('/create', [AdminProductController::class, 'create'])->name('product.create');

        Route::post('/store', [AdminProductController::class, 'store'])->name('product.store');

        Route::get('/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete');
    });

    Route::prefix('/slider')->group(function () {

        Route::get('/', [SliderAdminController::class, 'index'])->name('slider.index');
    
        Route::get('/create', [SliderAdminController::class, 'create'])->name('slider.create');

        Route::post('/store', [SliderAdminController::class, 'store'])->name('slider.store');

        Route::get('/edit/{id}', [SliderAdminController::class, 'edit'])->name('slider.edit');

        Route::post('/update/{id}', [SliderAdminController::class, 'update'])->name('slider.update');

        Route::get('/delete/{id}', [SliderAdminController::class, 'delete'])->name('slider.delete');

    });

});
Route::get('/admin', [AdminController::class, 'loginAdmin']);

Route::post('/admin', [AdminController::class, 'postloginAdmin']);


Route::group(['prefix' => 'filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
