@extends('backend.layouts.app')

@section('page-header')
    <h1>
        用户管理
        <small>用户密码修改</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.user.change-password',$user)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">用户密码修改</h3>

                <div class="box-tools pull-right">
                    @include('backend.user.includes.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">密码</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="密码" name="password" value="" id="password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-lg-2 control-label">确认密码</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="确认密码" name="password_confirmation" value="" id="password_confirmation" type="password">
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.user.index')}}" class="btn btn-danger btn-xs">取消</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="修改" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>
    </form>
@endsection