<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Vote;

class CommentVoteController extends Controller
{
    public function comment(Request $request)
    {
        $comment = Comment::create([
            'article_id' => $request->article_id,
            'text' => $request->text,
            'user_id' => $request->user_id
        ]);

        return response()->json(['status' => 'success', 'message' => 'Comment added', 'comment' => $comment], 201);
    }

    public function vote(Request $request)
    {
        Vote::create([
            'article_id' => $request->artcle_id, 'user_id' => $request->user_id
        ]);

        return response()->json(['status' => 'success', 'message' => 'Vote added'], 201);
    }

    public function getComments($id)
    {
        $comments = Comment::with('user')->where('article_id', $id)->get();

        return response()->json(['status' => 'success', 'message' => 'Comments retrieved', 'comments' => $comments], 200);
    }
}
