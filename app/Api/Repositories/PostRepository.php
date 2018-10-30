<?php

namespace App\Api\Repositories;

use App\Api\Models\Post;
use App\Repository\BaseRepository;
use App\Api\Finder\PostFinder;

/**
 * Post repository.
 */
class PostRepository extends BaseRepository
{
    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
        $this->finderClass = PostFinder::class;
    }
}
