@extends('backend.layouts.app')

@section('page-header')
    <h1>
        导航管理
        <small>导航编辑</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.navigation.update',$navigation)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">导航编辑</h3>

                <div class="box-tools pull-right">
                    @include('backend.navigation.includes.navigation-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">导航名称</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="导航名称" name="name" value="{{old('name')!=null?old('name'):$navigation->name}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="col-lg-2 control-label">类型</label>
                    <div class="col-lg-10">
                        <label>
                            <input type="radio" name="type" value="0" checked>URL
                        </label>
                        <label>
                            <input type="radio" name="type" value="1">页面
                        </label>
                    </div>
                </div>
                <div class="form-group" id="href">
                    <label for="href" class="col-lg-2 control-label">连接地址</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="http://" name="href" value="{{$navigation->href}}"  type="text">
                    </div>
                </div>
                <div class="form-group" id="page">
                    <label for="page" class="col-lg-2 control-label">页面</label>
                    <div class="col-lg-10">
                        <select class="form-control"  name="page">
                            @foreach($pages as $page)
                            <option value="{{$page->slug}}" {{old('page')==$page->slug?'selected':' '}}>{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="target" class="col-lg-2 control-label">打开方式</label>
                    <div class="col-lg-10">
                        <select class="form-control" id="target" name="target">
                            <option value="_self" {{$navigation->target=='_self'?'selected':' '}}>当前窗口打开</option>
                            <option value="_target" {{$navigation->target=='_target'?'selected':' '}}>新窗口打开</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sort" class="col-lg-2 control-label">排序</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="排序" name="sort" value="{{old('sort')!=null?old('sort'):$navigation->sort}}" id="sort" type="text">
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.navigation.index')}}" class="btn btn-danger btn-xs">取消</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="修改" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>

    </form>
@endsection
@section('js')
    <script type="text/javascript">
        $(function(){
            if($("input[name='type']:checked").val()==0){
                $("#href").show();
                $("#page").hide();
            }else{
                $("#href").hide();
                $("#page").show();
            }
            $("input[name='type']").click(function(){
                if($(this).val()==0){
                    $("#href").show();
                    $("#page").hide();
                }else{
                    $("#href").hide();
                    $("#page").show();
                }
            });
        });
    </script>
@endsection
