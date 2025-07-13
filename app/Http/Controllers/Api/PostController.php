<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Interfaces\PostServiceInterface;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Store a new post for a given website.
     * 
     * @param StorePostRequest $request
     * @param Website $website
     * @return JsonResponse
     */

    public function store(StorePostRequest $request, Website $website): JsonResponse
    {
        $post = $this->postService->createPost($website, $request->validated());

        return response()->json([
            'message' => 'Post successfully created and queued for email dispatch.',
            'data' => $post
        ], 201);
    }
}