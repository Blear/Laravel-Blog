@extends('backend.layouts.app')

@section('page-header')
    <h1>
        分类管理
        <small>添加分类</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">添加分类</h3>

                <div class="box-tools pull-right">
                    @include('backend.category.includes.category-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">分类名称</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="分类名称" name="name" value="{{old('name')}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-lg-2 control-label">slug</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="slug" name="slug" value="{{old('slug')}}" id="slug" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="parent_id" class="col-lg-2 control-label">父级分类</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="0">父级分类</option>
                            @foreach($categories as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sort" class="col-lg-2 control-label">排序</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="排序" name="sort" value="{{$category_count+1}}" id="sort" type="text">
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.category.index')}}" class="btn btn-danger btn-xs">取消</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="添加" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>

    </form>
@endsection
