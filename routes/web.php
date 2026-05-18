<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Controller;
//routes

Route::resource('/produits', ProduitController::class);
Route::controller(ProduitController::class)->group(function () {
    Route::get('/produits/byCat/{id}', 'indexByCategory');
});
Route::resource('/categories', CategorieController::class);

Route::view('/', 'welcome')->name('welcome');
