@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Artículos</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($articles as $article)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>
                                        {{$article->user->name}}
                                    </strong>
                                </div>
                                <div class="col-md-12">
                                    <strong>
                                        {{\Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i:s')}}
                                    </strong>
                                </div>
                                <div class="col-md-12"
                                style="
                                max-height: 150px;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                                    {{$article->content}}
                                </div>
                                <div class="col-md-4 offset-md-4 text-center">
                                    <img class="img-fluid" src="{{url('uploads/'.$article->image)}}" alt="">
                                </div>
                                <div class="col-md-12 text-right">
                                    Comentarios: {{$article->comments->count()}}
                                    @if (Gate::allows('update-article', $article))
                                        <a href="{{route('articles.edit', $article)}}">
                                            <button type="button" class="btn btn-warning">
                                                Editar Articulo
                                            </button>
                                        </a>
                                    @endif
                                    <a href="{{route('articles.show', $article)}}">
                                        <button type="button" class="btn btn-primary">
                                            Ver Articulo
                                        </button>
                                    </a>
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
