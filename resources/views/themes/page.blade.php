@extends('themes.layouts.layout')
@section('title',$page->title)
@section('css')
    <link rel="stylesheet" href="{{asset('themes/share/dist/css/share.min.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">博客</a></li>
                    <li class="active">{{$page->title}}</li>
                </ol>
                <article class="article well">
                    <header class="article-header">
                        <h1 class="article-title">
                            {{$page->title}}
                        </h1>
                        <div class="article-meta">
                            <li class="fa fa-calendar-o"></li><span><time datetime="2016-08-05T00:10:14+08:00">{{$page->created_at->format('Y-m-d')}}</time></span>
                        </div>
                    </header>
                    <article class="article-content">
                        <hr style="margin:0px 0px 15px 0px">
                        <p>{!! $page->content !!}</p>
                        <div class="share-bar"></div>
                    </article>
                </article>
                @include('themes.widget.comment',['comment_key'=>$page->as_name,'comment_title'=>$page->title])

            </div>

            <aside class="col-md-4">
                @include('themes.layouts.widgets')
            </aside>



        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('themes/share/dist/js/share.min.js')}}"></script>
    <script>
        $(function(){
            $('.share-bar').share();
        });
    </script>
@endsection