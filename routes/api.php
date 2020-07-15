<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('panier')->group(function () {
    Route::get('/', 'PanierController@index');
    Route::get('/show/{id}', 'PanierController@show');
    Route::delete('/delete/{id}', 'PanierController@destroy');
 });

 Route::prefix('espace')->group(function () {
    Route::get('/', 'EspaceVendeurController@index');
    Route::get('/show/{id}', 'EspaceVendeurController@show');
    Route::delete('/delete/{id}', 'EspaceVendeurController@destroy');
 });

 Route::prefix('produit')->group(function () {
    Route::get('/', 'ProduitController@index');
    Route::post('/store', 'ProduitController@store');
    Route::get('/show/{id}', 'ProduitController@show');
    Route::patch('/update/{id}', 'ProduitController@update');
    Route::delete('/delete/{id}', 'ProduitController@destroy');
 });