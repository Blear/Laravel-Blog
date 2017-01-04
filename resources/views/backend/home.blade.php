@extends('backend.layouts.app')
@section('page-header')
    <h1>
        管理面板
        <small>主页</small>
    </h1>
@endsection
@section('content')
<div class="row">
    @permission('manage-articles')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$article_count}}</h3>

                <p>文章</p>
            </div>
            <div class="icon">
                <i class="fa fa-edit"></i>
            </div>
            <a href="{{route('admin.article.index')}}" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endauth
    <!-- ./col -->
    @permission('manage-users')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$user_count}}</h3>

                <p>用户</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endauth
    <!-- ./col -->
    @permission('manage-categories')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$category_count}}</h3>

                <p>分类</p>
            </div>
            <div class="icon">
                <i class="fa fa-folder-o"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endauth
    <!-- ./col -->
    @permission('manage-tags')
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$tag_count}}</h3>

                <p>标签</p>
            </div>
            <div class="icon">
                <i class="fa fa-tag"></i>
            </div>
            <a href="#" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endauth
    <!-- ./col -->
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">操作</h3>
    </div>
    <div class="box-body">
        <a class="btn btn-app" href="{{route('admin.clear')}}">
            <i class="fa fa-repeat"></i>清除缓存
        </a>
    </div>
</div>
@endsection