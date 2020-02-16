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
Route::post('/catalog', 'CatalogController@search')->middleware('auth');

Route::get('/catalog', 'CatalogController@getIndex')->middleware('auth');

Route::get('/catalog/show/{id}', 'CatalogController@getShow')->middleware('auth');

Route::get('/favourites', 'FavouriteController@index')->middleware('auth');

Route::post('/catalog/show/{id}', 'FavouriteController@getFavourite')->middleware('auth');

Route::delete('/catalog/show/{id}', 'FavouriteController@deleteFavourite')->middleware('auth');

Route::get('/catalog/ranking', 'FavouriteController@ranking')->middleware('auth');

Route::get('/catalog/create', 'CatalogController@getCreate')->middleware('auth');

Route::get('/catalog/edit/{id}', 'CatalogController@getEdit')->middleware('auth');

Route::post('/catalog/create', 'CatalogController@postCreate')->middleware('auth');

Route::put('/catalog/edit/{id}', 'CatalogController@putEdit')->middleware('auth');

Route::put('/catalog/rent/{id}', 'CatalogController@putRent')->middleware('auth');

Route::put('/catalog/return/{id}', 'CatalogController@putReturn')->middleware('auth');

Route::delete('/catalog/delete/{id}', 'CatalogController@deleteMovie')->middleware('auth');

Route::post('/review/create/{id}', 'CatalogController@postReview')->middleware('auth');

//Route::resource('category','CategoryController');

Route::get('/category', 'CategoryController@index')->middleware('auth');

Route::get('/category/create', 'CategoryController@create')->middleware('auth');

Route::post('/category/create', 'CategoryController@store')->middleware('auth');

Route::get('/category/{category}', 'CategoryController@show')->middleware('auth');

Route::get('/category/{category}/edit', 'CategoryController@edit')->middleware('auth');

Route::put('/category/{category}', 'CategoryController@update')->middleware('auth');

Route::delete('/category/{category}', 'CategoryController@destroy')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


