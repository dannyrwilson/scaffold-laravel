<?php

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

// Use middleware "auth" to protect resource controllers. 
// Used resource controllers as task was pretty much crud.
Route::middleware(['auth'])->group(function () {
	Route::resources([
	    'categories' => 'CategoryController',
	    'products' => 'ProductController'
	]);
});

