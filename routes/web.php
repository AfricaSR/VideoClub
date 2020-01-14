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

Route::get('/', 'HomeController@getHome');


/*
Route::get('/login', function () { // Login usuario
    return view('auth.login');
});

Route::get('/logout', function () { // Logout usuario
    return view('logout');
});
*/
Route::get('/catalog', 'CatalogController@getIndex')->middleware('auth');

Route::get('/catalog/show/{id}', 'CatalogController@getShow')->middleware('auth');

Route::get('/catalog/create', 'CatalogController@getCreate')->middleware('auth');

Route::get('/catalog/edit/{id}', 'CatalogController@getEdit')->middleware('auth');

Route::post('/catalog/create', 'CatalogController@postCreate')->middleware('auth');

Route::put('/catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');

Route::put('/catalog/rent/{id}', 'CatalogController@putRent')->middleware('auth');

Route::put('/catalog/return/{id}', 'CatalogController@putReturn')->middleware('auth');

Route::delete('/catalog/delete/{id}', 'CatalogController@deleteMovie')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

