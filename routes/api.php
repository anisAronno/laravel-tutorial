<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('user', function () {
    $user = auth()->user();
    return response()->json($user, 200);
})->middleware(['auth:api']);

Route::get('blog', function () {
    $user = auth()->user();
    return response()->json($user->blogs, 200);
})->middleware(['auth:api']);
