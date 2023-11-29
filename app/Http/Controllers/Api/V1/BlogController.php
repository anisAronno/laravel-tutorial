<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\UsereResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieve successful',
            'user' => new UsereResource($user->load('blogs'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $user = $request->user();
        $blog = $user->blogs()->create($request->only('title', 'description'));

        if($blog) {
            return response()->json([
                'success' => true,
                'message' => 'Blog created successful',
                'blog' => new BlogResource($blog)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Blog created failed',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieve successful',
            'blog' => new BlogResource($blog)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($blog->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorize to edit this blog',
            ], 401);
        }

        $response = $blog->update($request->only('title', 'description'));

        if($response) {
            return response()->json([
                'success' => true,
                'message' => 'Blog updated successful',
                'blog' => new BlogResource($blog)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Blog updated failed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successful',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data deleted failed',
        ]);

    }
}
