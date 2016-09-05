<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/categories', ['as' => 'api.categories.index', 'uses' => 'CategoryController@index']);
Route::get('/categories/{id}', ['as' => 'api.categories.index', 'uses' => 'CategoryController@show']);
Route::get('/products', ['as' => 'api.products.index', 'uses' => 'ProductController@index']);
Route::get('/products/{id}', ['as' => 'api.products.index', 'uses' => 'ProductController@show']);
