<?php

namespace App\Http\Controllers\Wink;

use App\Contracts\Repositories\WinkPostRepository;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager;
use Solomon04\Documentation\Annotation\Group;
use Solomon04\Documentation\Annotation\Meta;
use Solomon04\Documentation\Annotation\ResponseExample;
use Wink\WinkPost;

/**
 * @Group(name="Blog", description="These routes are responsible for the wink blog.")
 */
class BlogController extends Controller
{
    /**
     * @var WinkPostRepository
     */
    private $winkPostRepository;

    public function __construct(WinkPostRepository $winkPostRepository)
    {
        $this->winkPostRepository = $winkPostRepository;
    }

    /**
     * @Meta(name="All Blog Posts", description="View all of the wink blog posts.", href="all-posts")
     * @ResponseExample(status=200, example="responses/wink/blog-posts/all.blog.posts-200.json")
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->winkPostRepository->with(['author', 'tags'])->all();

        if (is_null($posts)) {
            return ResponseFactory::error(
                'We could not find any blog posts.',
                null,
                404
            );
        }

        return ResponseFactory::success(
            'Blog posts found.',
            $posts
        );
    }

    /**
     * @Meta(name="All Blog Posts", description="View all of the wink blog posts.", href="all-posts")
     * @ResponseExample(status=200, example="responses/wink/blog-posts/show.blog.post-200.json")
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->winkPostRepository->with(['author', 'tags'])->findBySlug($slug);

        if(is_null($post)) {
            return ResponseFactory::error(
                'We could not find this blog post.',
                null,
                404
            );
        }

        return ResponseFactory::success(
            'Blog post found.',
            $post
        );
    }
}
