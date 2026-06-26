<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // GET /api/posts — anyone can list
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    // GET /api/my-posts — only the logged-in user's posts
    public function myPosts(Request $request)
    {
        $posts = $request->user()->posts()->with('user')->latest()->paginate(10);
        return PostResource::collection($posts);
    }

    // GET /api/posts/{post} — anyone can view
    public function show(Post $post)
    {
        return new PostResource($post->load('user'));
    }

    // POST /api/posts — auth required, attach logged-in user
    public function store(PostRequest $request)
    {
        $post = $request->user()->posts()->create(
            $request->validated()
        );
        return (new PostResource($post))->response()->setStatusCode(201);
    }

    // PUT /api/posts/{post} — only the owner can update
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $post->update($request->validated());
        return new PostResource($post);
    }

    // DELETE /api/posts/{post} — only the owner can delete
    public function destroy(Post $post, Request $request)
    {
        if ($post->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
