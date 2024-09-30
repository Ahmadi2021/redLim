<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['comments' => function($query) {
            $query->latest()->take(2);
        }])->latest()->paginate(10);
    
        return response()->json(['posts'=>$posts]);
    }

    public function store(PostRequest $request)
    {
        $user = auth()->user();
        $post = $user->posts()->create($request->only(['title', 'text']));

        return response()->json(['message' => 'Post created successfully']);
    }


        public function indexUserPosts($userId)
            {
                $posts = Post::where('user_id', $userId)
                            ->with(['comments' => function($query) {
                                $query->latest()->take(2);
                            }])->latest()->paginate(10);

                return response()->json(['posts'=>$posts]);
            }


        public function update(PostRequest $request, $id)
            {
               $post = auth()->user()->posts()->findOrFail($id);
                $post->update($request->only(['title', 'text']));

                return response()->json(['posts'=>$post]);
            }

            public function destroy($id)
            {
                $post = auth()->user()->posts()->findOrFail($id);
                $post->delete();

                return response()->json(['message' => 'Post Deleted successfully']);
            }
}
