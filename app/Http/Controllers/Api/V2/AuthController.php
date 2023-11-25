<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return response()->json('I am from version 2.0');
    }
}
