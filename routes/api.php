<?php

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

Route::get('http', function () {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'http://twitter.test/api/tweet');
    response()->json($res->getBody());
});
