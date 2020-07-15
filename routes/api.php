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
