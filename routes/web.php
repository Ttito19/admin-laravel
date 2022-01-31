<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\CategorieController;
use App\Http\controllers\BrandController;
use App\Http\controllers\BannerController;
use App\Http\controllers\ProductController;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home.index');
})->name('dashboard');
// Banners
Route::get('products/lista','App\Http\Controllers\ProductController@index');
Route::get('products/create','App\Http\Controllers\ProductController@create');
Route::get('products/edit/{id}','App\Http\Controllers\ProductController@edit');

Route::get('/listaProducts', [ProductController::class, 'fetchProducts']);
// Route::get('/edit-banner/{id}', [ProductController::class, 'edit']);
// Route::post('/create-banner', [ProductController::class, 'store']);

// Route::post('/update-banner/{id}', [ProductController::class, 'update']);
// Route::delete('/delete-banner/{id}', [ProductController::class, 'destroy']);

// Banners
Route::resource('banners','App\Http\Controllers\BannerController');
Route::get('/listaBanners', [BannerController::class, 'fechtBanners']);
Route::post('/create-banner', [BannerController::class, 'store']);
Route::get('/edit-banner/{id}', [BannerController::class, 'edit']);
Route::post('/update-banner/{id}', [BannerController::class, 'update']);
Route::delete('/delete-banner/{id}', [BannerController::class, 'destroy']);

// Marcas
Route::resource('brands','App\Http\Controllers\BrandController');
Route::get('/listaBrands', [BrandController::class, 'fechtBrands']);
Route::post('/create-brand', [BrandController::class, 'store']);
Route::get('/edit-brand/{id}', [BrandController::class, 'edit']);
Route::post('/update-brand/{id}', [BrandController::class, 'update']);
Route::delete('/delete-brand/{id}', [BrandController::class, 'destroy']);
// Categorías
// Route::get('categories', function () {
//     return view('categorie.index');
// });
Route::resource('categories','App\Http\Controllers\CategorieController');

Route::post('/create-categories', [CategorieController::class, 'store']);
Route::get('/listaCategorias', [CategorieController::class, 'fechtcategorias']);
Route::get('/edit-categorie/{id}', [CategorieController::class, 'edit']);
Route::post('/update-categorie/{id}', [CategorieController::class, 'update']);
Route::delete('/delete-categorie/{id}', [CategorieController::class, 'destroy']);
