@extends('themes.layouts.layout')
@section('title',$article->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">博客</a></li>
                    <li class="active">{{$article->title}}</li>
                </ol>
                <article class="article well">
                    <header class="article-header">
                        <h1 class="article-title">
                            {{$article->title}}
                        </h1>
                        <div class="article-meta">
                            <li class="fa fa-calendar-o"></li><span><time datetime="2016-08-05T00:10:14+08:00">{{$article->created_at->format('Y-m-d')}}</time></span>
                            <li class="fa fa-folder-o"></li><span><a href="{{route('category.show',$article->category->slug)}}"> {{$article->category->name}}</a></span>
                            <li class="fa fa-eye"></li><span>{{$article->view}}</span>
                        </div>
                    </header>
                    <article class="article-content">
                        <hr style="margin:0px 0px 15px 0px">
                        <p>{!! $article->content !!}</p>
                        <div class="tag-list">
                            <li class="fa fa-tag"></li>
                            <span class="tags-links">
                                @foreach($article->tags as $tag)
                                <a rel="tag" href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
                                @endforeach
                            </span>
                        </div>
                        <div class="article-copyright">
                            <p>本文地址:<a href="{{url()->current()}}">{{url()->current()}}</a></p>
                            <p>转载时请以链接形式注明出处</p>
                        </div>
                        <div class="social-share"></div>
                    </article>
                </article>

            @include('themes.widget.comment',['comment_key'=>$article->as_name,'comment_title'=>$article->title])
            </div>

            <aside class="col-md-4">
                @include('themes.layouts.widgets')
            </aside>
        </div>
    </div>
@endsection