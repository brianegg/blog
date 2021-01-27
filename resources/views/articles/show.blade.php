@extends('layouts.app')
@section('title')
Articulo
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Articulo</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{$article->user->name}}
                        </div>
                        <div class="col-md-12">
                            {{$article->content}}
                        </div>
                        <div class="col-md-6 offset-md-3 text-center mt-2">
                            <img class="img-fluid" src="{{url('uploads/'.$article->image)}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Comentario:
                        </div>
                        <div class="col-md-12">
                            <form action="{{route('comments.storeComment', $article)}}" method="POST">
                                @csrf
                                <textarea class="w-100" name="text" rows="5"></textarea>
                                <button type="submit" class="btn btn-primary float-right">Comentar</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Comentarios</h3>
                        </div>
                        @foreach ($article->comments as $comment)
                        <div class="col-md-12 mt-2">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>{{$comment->user->name}}</h4>
                                        </div>
                                        <div class="col-md-6">
                                            @if (Gate::allows('delete-comment', $comment))
                                                <form action="{{route('comments.destroy', $comment)}}" method="post" class="float-right">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>{{$comment->text}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
