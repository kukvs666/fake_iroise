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

Route::get('/page1', function () {
    return view('page1');
});

Route::get('page2', function () {
    return 'hello world';
});

Route::get('page3/{id}', function ($id) {
    return view('page3',['id' => $id]);
});
Route::get('mjml/voir', function () {
    return view('mjml/voir');
});
Route::get('mjml','mjmlController@getForm');
Route::post('mjml', 'mjmlController@postForm');



// Toute les routes précédente ne doivent pas être prise en compte, c'est mon sandbox.
//      |
//      V

Route::get('challenge', function () {
    return view('challenge');
});

