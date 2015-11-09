<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');
Route::resource('advertiser', 'AdvertiserController');
Route::resource('publisher', 'PublisherController');
Route::resource('advertiser-buss', 'AdvertiserBussController');
Route::resource('publisher-buss', 'PublisherBussController');
Route::resource('review', 'ReviewController');
post('logout', 'UserController@logout');