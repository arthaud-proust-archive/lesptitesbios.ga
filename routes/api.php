<?php

use Illuminate\Http\Request;



Route::group(['middleware' => ['cors']], function() {
    
    // Auth
    Route::post('login', 'UsersController@login');
    Route::post('register', 'UsersController@store');
    //token
    Route::post('token', 'UsersController@verifyToken');


    // Don't need to be logged
    
    Route::get('intro', 'IntroController@index');


    Route::get('persons', 'PersonsController@index');
    Route::get('person/{slug}', 'PersonsController@show');
    Route::get('person/{slug}/artworks', 'PersonsController@artworks');
    
    
    Route::get('artworks', 'ArtworksController@index');
    Route::get('artworks/person/{slug}', 'ArtworksController@get');
    Route::get('artwork/{slug}', 'ArtworksController@show');

});




// Need to be logged
Route::group(['middleware' => ['jwt.auth', 'level']], function()
{
    
    // intro
    Route::post('intro/edit', 'IntroController@update');

    // trash
    Route::get('trash', 'TrashController@index');
    Route::get('trash/{id}', 'TrashController@view');
    Route::post('trash/{id}', 'TrashController@restore');
    Route::delete('trash/{id}', 'TrashController@destroy');




    // persons
    
    Route::post('person/new', 'PersonsController@store');

    Route::post('person/{slug}/edit', 'PersonsController@update');
    
    Route::post('person/{slug}/delete', 'PersonsController@destroy');
    
    
    
    // artworks
    
    Route::post('artwork/new', 'ArtworksController@store');
    
    Route::post('artwork/{slug}/edit', 'ArtworksController@update');

    Route::post('artwork/{slug}/delete', 'ArtworksController@destroy');

});