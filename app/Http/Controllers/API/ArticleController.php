<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $articles = Article::with('user', 'comments', 'votes')->orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $articles, 200]);
    }


    public function store(Request $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);

        return response()->json(['status' => 'success', 'articles' => $article], 201);
    }


    public function show($id)
    {
        $article = Article::with('user', 'comments', 'votes')->where('id', $id)->get();
        if (!$article) {
            return response()->json(['status' => 'error', 'message' => 'Article not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $article], 201);
    }




    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['status' => 'success', 'message' => 'Article not found'], 404);
        }

        $article->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Article Updated successfully.', 'articles' => $article], 200);
    }


    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['status' => 'error', 'message' => 'Article not found'], 404);
        }

        $article->delete();

        return response()->json(['status' => 'success', 'message' => 'Article deleted successfully.', 'articles' => $article], 201);
    }
}
