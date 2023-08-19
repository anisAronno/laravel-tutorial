<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->controller(UserController::class)->middleware('test')->name('user.')->group(function () {
    Route::get('user', 'index')->name('all');
    Route::get('/user/{user}', 'show')->where('id', '[0-9]+')->name('show');
    Route::post('/user', 'store')->name('store');
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/blog-view', [PostController::class, 'index'])->name('post');


Route::get('/contact', [ContactController::class, 'index']);

Route::any('/test', function () {
    return 'test any';
});

// Route::redirect('/here', route('post'));

Route::view('/welcome', 'home', ['data' => 'test view data']);
