@extends('themes.layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">博客</a></li>
                    <li class="active">{{$tag->name}}</li>
                </ol>
                @foreach($articles as $article)
                <article class="article">
                    <div class="article-head">
                        <h2 class="article-title"><a href="{{route('article.show',$article->as_name)}}">{{$article->title}}</a></h2>
                        <div class="article-meta">
                            <li class="fa fa-calendar-o"></li><span><time datetime="2016-11-07T00:10:14+08:00">{{$article->created_at->format('Y-m-d')}}</time></span>
                            <li class="fa fa-folder-o"></li><span><a href="{{route('category.show',$article->category->slug)}}">{{$article->category->name}}</a></span>
                            <li class="fa fa-eye"></li><span>{{$article->view_count}}</span>
                        </div>
                    </div>
                    <div class="article-description">
                        <p>{{$article->description}}</p>
                    </div>
                    <div class="article-footer">
                        <span class="tags-links">
                            @foreach($article->tags as $tag)
                            <a rel="tag" href="{{route('tag.show',$tag->name)}}">{{ $tag->name }}</a>
                            @endforeach
                        </span>
                        <a class="more-link" href="{{route('article.show',$article->as_name)}}">阅读全文 »</a>
                    </div>
                </article>
                @endforeach
                <nav>
                    {{$articles->links()}}
                </nav>
            </div>

            <aside class="col-md-4">
                @include('themes.layouts.widgets')
            </aside>
        </div>
    </div>
@endsection