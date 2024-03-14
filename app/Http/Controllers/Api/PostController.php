<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        return PostResource::collection($post);
    }

    public function store(Request $request){

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
          ]);

         return new PostResource($post); 
    }

    public function show(Post $post)
    {
      return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
      $post->update($request->only(['title', 'body']));
      
      return new PostResource($post);
    }

    public function destroy(Post $post)
    {
      $post->delete();

      return response()->json(null, 204);
    }

}
