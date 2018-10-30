<?php

namespace App\Api\Controllers;

use App\Api\Builder\PostBuilder;
use App\Api\Repositories\PostRepository;
use App\Api\Requests\PostCreateRequest;
use App\Api\Requests\PostIndexRequest;
use App\Api\Requests\PostUpdateRequest;
use App\Api\Resources\PostResource;
use App\Api\Services\PostService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Rorecek\Ulid\Facades\Ulid;

/**
 * Post controller.
 */
class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $service;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @param PostService $service
     * @param PostRepository $repository
     */
    public function __construct(PostService $service, PostRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * List of all posts.
     *
     * @param PostIndexRequest $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(PostIndexRequest $request): AnonymousResourceCollection
    {
        return PostResource::collection(
            $this->repository
                ->find()
                ->search()
                ->paginate($request->input('per_page', 15))
        );
    }

    /**
     * Show post by its id.
     *
     * @param string $id
     *
     * @return PostResource
     */
    public function show(string $id): PostResource
    {
        $model = $this->repository->read($id);

        return new PostResource($model);
    }

    /**
     * Update post.
     *
     * @param string $id
     * @param PostUpdateRequest $request
     *
     * @return PostResource
     */
    public function update(string $id, PostUpdateRequest $request): PostResource
    {
        $builder = new PostBuilder();
        $builder
            ->setTitle($request->input('title'))
            ->setShortDescription($request->input('short_description'))
            ->setDescription($request->input('description'));

        $this->service->update($id, $builder);
        $model = $this->repository->read($id);

        return new PostResource($model);
    }

    /**
     * Creating new post.
     *
     * @param PostCreateRequest $request
     *
     * @return PostResource
     */
    public function store(PostCreateRequest $request): PostResource
    {
        $id = Ulid::generate();
        $builder = new PostBuilder();
        $builder
            ->setId($id)
            ->setTitle($request->input('title'))
            ->setShortDescription($request->input('short_description'))
            ->setDescription($request->input('description'));

        $this->service->create($builder);
        $model = $this->repository->read($id);
        $model->wasRecentlyCreated = true;

        return new PostResource($model);
    }

    /**
     * Deleting post.
     *
     * @param string $id
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(string $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json([], 204);
    }
}
