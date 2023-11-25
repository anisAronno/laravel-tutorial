<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('user', function () {
    $user = auth()->user();
    return response()->json($user, 200);
})->middleware(['auth:api']);

Route::get('blog', function () {
    $user = auth()->user();
    return response()->json($user->blogs, 200);
})->middleware(['auth:api']);
