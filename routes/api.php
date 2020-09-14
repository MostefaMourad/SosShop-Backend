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

Route::post('acheteur/login', 'API\AcheteurLoginController@login');
Route::post('acheteur/register', 'API\AcheteurRegisterController@register');
Route::post('acheteur/logout', 'API\AcheteurLoginController@logout');

Route::group(['middleware' => 'auth:acheteur-api'], function(){
   Route::get('acheteur/profil', 'API\AcheteurController@profil');
});

Route::post('vendeur/login', 'API\VendeurLoginController@login');
Route::post('vendeur/register', 'API\VendeurRegisterController@register');
Route::post('vendeur/logout', 'API\VendeurLoginController@logout');

Route::group(['middleware' => 'auth:vendeur-api'], function(){
   Route::get('vendeur/profil', 'API\VendeurController@profil');
});

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

 Route::prefix('commande')->group(function () {
    Route::get('/', 'CommandeController@index');
    Route::post('/store', 'CommandeController@store');
    Route::get('/show/{id}', 'CommandeController@show');
    Route::patch('/update/{id}', 'CommandeController@update');
    Route::delete('/delete/{id}', 'CommandeController@destroy');
 });

 Route::prefix('acheteur')->group(function () {
   Route::get('/', 'AcheteurController@index');
   Route::get('/show/{id}', 'AcheteurController@show');
   Route::delete('/delete/{id}', 'AcheteurController@destroy');
});

Route::prefix('vendeur')->group(function () {
   Route::get('/', 'VendeurController@index');
   Route::get('/show/{id}', 'VendeurController@show');
   Route::delete('/delete/{id}', 'VendeurController@destroy');
});

Route::prefix('categorie')->group(function () {
   Route::get('/', 'CategorieController@index');
   Route::post('/store', 'CategorieController@store');
   Route::get('/show/{id}', 'CategorieController@show');
   Route::patch('/update/{id}', 'CategorieController@update');
   Route::delete('/delete/{id}', 'CategorieController@destroy');
});

Route::prefix('souscategorie')->group(function () {
   Route::get('/', 'SousCategorieController@index');
   Route::post('/store', 'SousCategorieController@store');
   Route::get('/show/{id}', 'SousCategorieController@show');
   Route::patch('/update/{id}', 'SousCategorieController@update');
   Route::delete('/delete/{id}', 'SousCategorieController@destroy');
});

Route::prefix('service')->group(function () {
   Route::get('/', 'ServiceController@index');
   Route::post('/store', 'ServiceController@store');
   Route::get('/show/{id}', 'ServiceController@show');
   Route::post('/update/{id}', 'ServiceController@update');
   Route::delete('/delete/{id}', 'ServiceController@destroy');
});

Route::prefix('publicite')->group(function () {
   Route::get('/', 'PubliciteController@index');
   Route::post('/store', 'PubliciteController@store');
   Route::get('/show/{id}', 'PubliciteController@show');
   Route::delete('/delete/{id}', 'PubliciteController@destroy');
});

Route::prefix('faq')->group(function () {
   Route::get('/', 'FaqController@index');
   Route::post('/store', 'FaqController@store');
   Route::get('/show/{id}', 'FaqController@show');
   Route::patch('/update/{id}', 'FaqController@update');
   Route::delete('/delete/{id}', 'FaqController@destroy');
});

Route::prefix('message')->group(function () {
   Route::get('/', 'MessageController@index');
   Route::post('/store', 'MessageController@store');
   Route::get('/show/{id}', 'MessageController@show');
   Route::delete('/delete/{id}', 'MessageController@destroy');
});

Route::prefix('accueil')->group(function () {
   Route::get('/', 'PublicController@home');
});


