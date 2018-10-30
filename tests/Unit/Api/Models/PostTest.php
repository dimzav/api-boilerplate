<?php

namespace Unit\Api\Models;

use App\Api\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testing creating.
     */
    public function testCreate()
    {
        $model = factory(Post::class)->create();

        $this->assertDatabaseHas('posts', $model->getAttributes());
    }

    /**
     * Testing updating.
     */
    public function testUpdate()
    {
        $model = factory(Post::class)->create();
        $fakeModel = factory(Post::class)->make();
        $oldModel = clone $model;
        $model->fill($fakeModel->getAttributes()); /** @var Post $model */
        $model->save();

        $this->assertDatabaseHas('posts', $model->getAttributes());
        $this->assertDatabaseMissing('posts', $oldModel->getAttributes());
    }

    /**
     * Testing deleting.
     */
    public function testDelete()
    {
        $model = factory(Post::class)->create();
        $model->delete();

        $this->assertDatabaseMissing('posts', $model->getAttributes());
    }
}
