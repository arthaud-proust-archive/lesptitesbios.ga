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

// Route::get('error/{code}', function ($code) {
//     return view('errors.'.$code);
// });


Route::get('/{any}', 'SpaController@index')->where('any', '^((?!api).)*');
//where('any', '.*')
