<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
        public function store(Request $request)
        {
            $user = auth()->user();
            $comment = $user->comments()->create($request->only(['post_id', 'text']));

            return response()->json(['message' => 'Comment created successfully']);
        }

        public function indexPostComments($postId)
        {
            $comments = Comment::where('post_id', $postId)->with('children')->latest()->paginate(10);

            return response()->json(['comments' => $comments]);
        }
}
