<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


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

// Route::get('contact', function() {
//     return view('contact.index');
// });

// Route::get('/', function() {
//     return view('home');
// });

Route::view('/', 'home')->name('homepage');

Route::view('/admin/home', 'home');

Route::get('/admin/about', function() {

    // first core php way

    // $name = 'Hadayat Niazi';
    // $names = ['Hadayat Niazi', 'Sohail', 'Gohar'];

    // return view('about', compact('name', 'names'));


    // == Second array way
    // $name = 'Hadayat Niazi';
    // $names = ['Hadayat Niazi', 'Sohail', 'Gohar'];

    // return view('about', ['name' => $name, 'names' => $names] );


    // == Third with way
    $name = 'Hadi';
    $names = [];


    return view('about')
            ->with('name', $name)
            ->with('names', $names);

})->name('about-us');

// Route::redirect('/', 'about');

Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');

Route::get('posts/show/{id}', [PostController::class, 'show'])->name('posts.show');
