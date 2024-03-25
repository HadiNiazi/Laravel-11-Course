<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function(){

//    return 'Hello World';

// });

// Route::get('/about', function() {

//     return 'about us page';

// });

// Route::get('users/{id}', function($userId) {

//     return 'User id is '. $userId;

// });


// Route::get('users/{id?}', function($userId = null) {

//     return 'User id is '. $userId;

// });


// Route::get('users/{id}', function($userId) {

//     return 'User id is '. $userId;

// })->where('id', '[0-9]+');


// Route::get('users/{name}', function($name) {

//     return 'User name is '. $name;

// })->where('name', '[a-zA-z]+');

Route::get('/', function() {

    return view('home');

});

