<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Article $article){
        $user_id = Auth::id();
        $ya_hay_like = Like::where('article_id', $article->id)->where('user_id', $user_id)->first();
        if(empty($ya_hay_like)){
            $like = new Like;
            $like->article_id = $article->id;
            $like->user_id = $user_id;
            $like->save();
            return redirect()->back();
        }else{
            return redirect()->back();
            // el usuario ya le ha dado like al articulo
        }
    }
}
