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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('challenge', 'ChallengeController');

//get data for nodes
Route::get('challenge-data', 'ChallengeController@getData')->name('challenge-data');
Route::resource('challenge', 'ChallengeController');

//get data for nodes
Route::get('challenge-data', 'ChallengeController@getData')->name('challenge-data');
Route::resource('challenge', 'ChallengeController');

//get data for nodes
Route::get('challenge-data', 'ChallengeController@getData')->name('challenge-data');
Route::resource('post', 'PostController');

//get data for nodes
Route::get('post-data', 'PostController@getData')->name('post-data');
Route::resource('challenge', 'ChallengeController');

//get data for nodes
Route::get('challenge-data', 'ChallengeController@getData')->name('challenge-data');
Route::resource('post', 'PostController');

//get data for nodes
Route::get('post-data', 'PostController@getData')->name('post-data');
