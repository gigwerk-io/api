<?php

namespace Tests\Feature\Http\Controllers\Wink;

use App\Contracts\Repositories\WinkPostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Database\DatabaseManager;
use Tests\ResponseFactoryTest;
use Wink\WinkAuthor;
use Wink\WinkPost;

/**
 * @coversDefaultClass \App\Http\Controllers\Wink\BlogController
 */
class BlogControllerTest extends TestCase
{
    const DOC_PATH = 'wink/blog-posts';
    const ALL_BLOG_POSTS_ROUTE = 'all.blog.posts';
    const SHOW_BLOG_POST_ROUTE = 'show.blog.post';

    public $post;

    public $author;

    protected function setUp(): void
    {
        parent::setUp();
        $this->author = factory(WinkAuthor::class)->create();
        $this->post = factory(WinkPost::class)->create([
            "author_id" => $this->author->id
        ]);
    }

    /**
     * @covers ::index
     */
    public function testViewAllBlogPosts()
    {
        $response = $this->get(route(self::ALL_BLOG_POSTS_ROUTE));
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['author', 'title', 'tags']]]);
        $this->document(self::DOC_PATH, self::ALL_BLOG_POSTS_ROUTE, $response->status(), $response->getContent());
    }

    /**
     * @covers ::show
     */
    public function testViewBlogPost()
    {
        $response = $this->get(route(self::SHOW_BLOG_POST_ROUTE, ['id' => $this->post->id]));
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['author', 'title', 'tags']]);
        $this->document(self::DOC_PATH, self::SHOW_BLOG_POST_ROUTE, $response->status(), $response->getContent());
    }
}
