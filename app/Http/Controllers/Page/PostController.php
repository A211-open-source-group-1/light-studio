<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select(['posts.*', 'users.name'])
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(12);
        $title = 'Tin tức mới nhất hót hòn họt';
        return view('page.post', compact('posts', 'title'));
    }

    public function post($id)
    {
        $post = Post::select(['posts.*', 'users.name'])
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', '=', $id)
            ->first();
        $title = $post->title;
        return view('page.post_detail', compact('post', 'title'));
    }
}