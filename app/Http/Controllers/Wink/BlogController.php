<?php

namespace App\Http\Controllers\Wink;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager;
use Wink\WinkPost;

class BlogController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        $posts = $this->databaseManager->select("select * from wink_posts");

        if ($posts) {
            return ResponseFactory::success(
                'Blog posts found.',
                ['posts' => $posts]
            );
        } else {
            return ResponseFactory::error(
                'We could not find any blog posts.',
                null,
                404
            );
        }
    }

    public function show($id)
    {
        $post = $this->databaseManager->select("select * from wink_posts where id = ? limit 1", [$id]);

        if($post) {
            return ResponseFactory::success(
                'Blog post found.',
                ['post' => $post]
            );
        } else {
            return ResponseFactory::error(
                'We could not find this blog post.',
                null,
                404
            );
        }
    }
}
