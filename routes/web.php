<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->as('admin.')->middleware('auth')->group(function() {
    Route::resource('posts', PostController::class);
    Route::get('regular-posts', [PostController::class, 'openRegularPosts']);
    Route::get('users', [PostController::class, 'users'])->name('users');
});


Route::get('/about', function() {
    return 'About us';
})->name('about-us');

require __DIR__.'/auth.php';
