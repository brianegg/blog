<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Article $article, Request $request){
        $article = Article::find($article->id);
        if(empty($article)){
            return redirect()->back();
        }
        $datosValidados = request()->validate(
            [
                'text' => 'required'
            ]
        );
        $comentario = new Comment;
        $comentario->user_id = Auth::id();
        $comentario->article_id = $article->id;
        $comentario->text = $datosValidados['text'];
        $comentario->save();
        return redirect()->back();
    }

    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->back();
    }
}
