<?php

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

Route::get('/login', 'App\Http\Controllers\MainController@login')->name('login');

Route::get('/', function () {
    return view('welcome');
});


Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');

Route::get('/', 'App\Http\Controllers\MainController@index')->name('welcome');

Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\AuthController@verify')->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/email/verify', 'App\Http\Controllers\AuthController@verifyNotice')->middleware('auth')->name('verification.notice');
Route::post('/email/verify/resend', 'App\Http\Controllers\AuthController@verifyResend')->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');

Route::get('/przepis/edycja/{recipe}', 'App\Http\Controllers\RecipeController@edit')->name('recipe.edit')->middleware('userIsOwner');
Route::patch('/przepis/edycja/{recipe}', 'App\Http\Controllers\RecipeController@update')->name('recipe.update')->middleware('userIsOwner');

Route::get('/przepis/dodaj', 'App\Http\Controllers\RecipeController@create')->name('przepis.create');
Route::post('/przepis/dodaj', 'App\Http\Controllers\RecipeController@add')->name('przepis.add');
Route::post('/przepis/delete/{recipe}', 'App\Http\Controllers\RecipeController@delete')->name('recipe.delete')->middleware('userIsOwner');
Route::get('/przepis/moje', 'App\Http\Controllers\MyRecipesController@index')->name('przepis.moje');
Route::get('/przepis/{recipe}', 'App\Http\Controllers\RecipeController@index')->name('recipe.details');