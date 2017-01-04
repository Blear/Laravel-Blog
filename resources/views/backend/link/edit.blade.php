@extends('backend.layouts.app')

@section('page-header')
    <h1>
        友情链接管理
        <small>链接编辑</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.link.update',$link)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">链接编辑</h3>

                <div class="box-tools pull-right">
                    @include('backend.link.includes.link-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">链接名称</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="链接名称" name="name" value="{{old('name')!=null?old('name'):$link->name}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group" id="href">
                    <label for="href" class="col-lg-2 control-label">连接地址</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="http://" name="href" value="{{$link->href}}"  type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sort" class="col-lg-2 control-label">排序</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="排序" name="sort" value="{{old('sort')!=null?old('sort'):$link->sort}}" id="sort" type="text">
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.link.index')}}" class="btn btn-danger btn-xs">取消</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="修改" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>

    </form>
@endsection

