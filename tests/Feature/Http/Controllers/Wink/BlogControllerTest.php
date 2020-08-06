<?php

namespace Tests\Feature\Http\Controllers\Wink;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Database\DatabaseManager;
use Tests\ResponseFactoryTest;

/**
 * @coversDefaultClass \App\Http\Controllers\Wink\BlogController
 */
class BlogControllerTest extends TestCase
{
    const DOC_PATH = 'wink/blog-posts';
    const ALL_BLOG_POSTS_ROUTE = 'all.blog.posts';
    const SHOW_BLOG_POST_ROUTE = 'show.blog.post';



    public function testShowApplicant()
    {
        $response = $this->get(route(self::SHOW_BLOG_POST_ROUTE, ['id' => '6342be30-9704-4f51-9f8c-929e4f990ce6']));
        $response->assertStatus(200);
        $response->assertJsonStructure();
        $this->document(self::DOC_PATH, self::SHOW_BLOG_POST_ROUTE, $response->status(), $response->getContent());
    }
}
