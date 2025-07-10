<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request, Website $website)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $post = $website->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }
}
