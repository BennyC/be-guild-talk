<?php

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostStatusIsEnum()
    {
        /** @var Post $post */
        $post = Post::factory()->create(['status' => PostStatus::Published]);
        $this->assertInstanceOf(PostStatus::class, $post->status);
        $this->assertTrue($post->status->visible());
    }
}
