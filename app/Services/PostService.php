<?php

namespace App\Services;

use App\Interfaces\PostServiceInterface;
use App\Models\Post;
use App\Models\Website;
use App\Models\Subscriber;
use App\Jobs\SendPostJob;

class PostService implements PostServiceInterface
{
    public function createPost(Website $website, array $data): Post
    {
        $post = $website->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
        
        // Queue email to all subscribers
        foreach ($website->subscribers as $subscriber) {
            SendPostJob::dispatch($post, $subscriber);
        }

        return $post;
    }
}