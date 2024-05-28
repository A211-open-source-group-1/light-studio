<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.post.post', compact('posts'));
    }

    public function addNewPost(Request $request)
    {
        $newPost = new Post();
        $thumbnailFileName = 'no_image.png';
        if ($request->file('thumbnail') != null) {
            $thumbnailFileName = 'thumbnail_' . uniqId() . '.' . $request->file('thumbnail')->extension();
            $request->file('thumbnail')->storeAs('image', $thumbnailFileName, 'imageUpload');
        }

        $newPost->title = $request->title;
        $newPost->thumbnail = $thumbnailFileName;
        $newPost->user_id = Auth::user()->id;

        $content = $request->content;
        if ($content == '') {
            $content = '<p></p>';
        }
        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $content = $dom->saveHTML();
        $newPost->content = $content;

        $newPost->save();

        return redirect()->back();
    }

    public function deletePost(Request $request)
    {
        $post = Post::where('id', '=', $request->post_id)->first();
        $post->delete();
        return redirect()->back();
    }

    public function editPost(Request $request)
    {
        $editedPost = Post::where('id', '=', $request->post_id)->first();
        $thumbnailFileName = $editedPost->thumbnail;
        if ($request->file('thumbnail') != null) {
            $thumbnailFileName = 'thumbnail_' . uniqId() . '.' . $request->file('thumbnail')->extension();
            $request->file('thumbnail')->storeAs('image', $thumbnailFileName, 'imageUpload');
        }

        $content = $request->content;
        if ($content == '') {
            $content = '<p></p>';
        }

        $dom = new DOMDocument();
        $dom->encoding = 'utf-8';
        @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $content = $dom->saveHTML();

        $editedPost->update([
            'title' => $request->title,
            'thumbnail' => $thumbnailFileName,
            'content' => $content
        ]);

        return redirect()->back();
    }

    public function getPost($post_id)
    {
        $post = Post::where('id', '=', $post_id)->first();
        return response()->json($post);
    }
}