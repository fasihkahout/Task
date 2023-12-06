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

Route::post('register',"RegisterController@register");
Route::post('login',"LoginController@login");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('interaction', 'InteractionController@index')->name('interaction');
Route::post('postinteraction', 'InteractionController@store')->name('postinteraction');
Route::put('updateinteraction', 'InteractionController@update')->name('updateinteraction');
Route::delete('deleteinteraction', 'InteractionController@delete')->name('deleteinteraction');

