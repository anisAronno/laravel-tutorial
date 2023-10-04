<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->orderByDesc('id')->simplePaginate(10);
        return view('home', compact('blogs'));
    }


}
