<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();
        return view('home', compact('articles'));
    }

    public function create(){
        return view('articles.create');
    }

    public function store(Request $request){
        $datosValidados = request()->validate(
            [
                'content' => 'required',
                'image' => 'mimes:jpeg,jpg,png|required'
            ]
        );

        $datosValidados['user_id'] = Auth::id();

        $imagen = $request['image'];
        $extension = $imagen->getClientOriginalExtension();
        $datosValidados['image'] = $imagen->getFilename().'.'.$extension;
        Storage::disk('public')->put($datosValidados['image'],  File::get($imagen));

        $article = new Article($datosValidados);
        $article->save();
        return redirect(route('articles.edit', $article->id));
    }

    public function show(Article $article){
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article){
        if($article->user_id != Auth::id()) {
            Abort(403);
        }
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article){
        $datosValidados = request()->validate(
            [
                'content' => 'required',
                'image' => 'mimes:jpeg,jpg,png|nullable',
            ]
        );
        if($request['image']){
            $imagen = $request['image'];
            $extension = $imagen->getClientOriginalExtension();
            $datosValidados['image'] = $imagen->getFilename().'.'.$extension;
            Storage::disk('public')->delete($request['imagen_anterior']);
            Storage::disk('public')->put($datosValidados['image'],  File::get($imagen));
        }else{
            $datosValidados['image'] = $request['imagen_anterior'];
        }
        $article->update($datosValidados);

        return redirect()->back();
    }

    public function destroy(Article $article){
        Storage::disk('public')->delete($article->image);
        $article->delete();
        return redirect('/home');
    }
}
