<?php

namespace App\Interfaces;

use App\Models\Post;
use App\Models\Website;

interface PostServiceInterface
{
    public function createPost(Website $website, array $data): Post;
}