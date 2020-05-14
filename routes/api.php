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




// Need to be logged and user (level: 1)
Route::group(['middleware' => ['jwt.auth', 'level-user']], function()
{
    // user (level: 1)
    // can only add person and artwork, 
    Route::post('person/new', 'PersonsController@store');
    Route::post('artwork/new', 'ArtworksController@store');

    // can modify his name and contact except permLevel. Only Admin can change it
    Route::patch('users/{id}', 'UsersController@update');


    // modo (level: 2)
    // can add, edit and delete persons and artworks without change badges
    Route::group(['middleware' => ['level-modo']], function() {
        // persons
        Route::post('person/{slug}/edit', 'PersonsController@update');
        Route::post('person/{slug}/delete', 'PersonsController@destroy');
        
        // artworks
        Route::post('artwork/{slug}/edit', 'ArtworksController@update');
        Route::post('artwork/{slug}/delete', 'ArtworksController@destroy');



        // admin (level: 3)
        // can manage intro, trash, persons and artworks
        Route::group(['middleware' => ['level-admin']], function() {
            // intro
            Route::post('intro/edit', 'IntroController@update');
            
            // users
            Route::get('users', 'UsersController@index');

            // logs
            Route::get('logs', 'LogsController@index');

            // trash
            Route::get('trash', 'TrashController@index');
            Route::get('trash/{id}', 'TrashController@view');
            Route::post('trash/{id}', 'TrashController@restore');
            Route::delete('trash/{id}', 'TrashController@destroy');
        }); 

        
    });


    
});