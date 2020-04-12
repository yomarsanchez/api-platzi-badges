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

Route::get('/badges', 'BadgeController@index')->name('badges');

Route::get('/badges/{badge}', 'BadgeController@show')
    ->where('badge', '^[\w-=_]*$')
    ->name('badges.show');

Route::post('/badges', 'BadgeController@store')->name('badges.store');

Route::put('/badges/{badge}', 'BadgeController@update')
    ->where('badge', '^[\w-=_]*$')
    ->name('badges.update');

Route::delete('/badges/{badge}', 'BadgeController@destroy')
    ->where('badge', '^[\w-=_]*$')
    ->name('badges.destroy');
