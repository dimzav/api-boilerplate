<?php

namespace App\Api\Services;

use App\Api\Builder\PostBuilder;
use App\Api\Repositories\PostRepository;

/**
 * Service object to manage posts.
 */
class PostService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Creating post.
     *
     * @param PostBuilder $builder
     */
    public function create(PostBuilder $builder): void
    {
        $this->repository->create($builder);
    }

    /**
     * Updating post.
     *
     * @param string $id
     * @param PostBuilder $builder
     */
    public function update(string $id, PostBuilder $builder): void
    {
        $this->repository->update($id, $builder);
    }

    /**
     * Deleting post.
     *
     * @param string $id
     *
     * @throws \Exception
     */
    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}
