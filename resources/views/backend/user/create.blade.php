@extends('backend.layouts.app')

@section('page-header')
    <h1>
        用户管理
        <small>添加用户</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.user.store')}}" method="post">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">添加用户</h3>

                <div class="box-tools pull-right">
                    @include('backend.user.includes.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">用户名</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="用户名" name="name" value="{{old('name')}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">邮箱</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="邮箱" name="email" value="{{old('email')}}" id="email" type="text">
                    </div>
                </div>
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
                <div class="form-group">
                    <label for="status" class="col-lg-2 control-label">启用</label>

                    <div class="col-lg-1">
                        <input name="status" value="1" id="status" type="checkbox" checked="checked">
                    </div><!--col-lg-1-->
                </div>

                <div class="form-group">
                    <label for="assignees_roles" class="col-lg-2 control-label">所属角色</label>

                    <div class="col-lg-3">
                        @if (count($roles) > 0)
                            @foreach($roles as $role)
                                <input type="checkbox" value="{{$role->id}}" name="assignees_roles[{{ $role->id }}]" {{ is_array(old('assignees_roles')) && in_array($role->id, old('assignees_roles')) ? 'checked' : '' }} id="role-{{$role->id}}" /> <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                    (
                                    <span class="show-text">显示详细</span>
                                    <span class="hide-text hidden">隐藏详细</span>
                                    权限
                                    )
                                </a>
                                <br/>
                                <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                    @if ($role->all)
                                        全局权限
                                    @else
                                        @if (count($role->permissions) > 0)
                                            <blockquote class="small">{{--
                                            --}}@foreach ($role->permissions as $perm){{--
                                            --}}{{$perm->display_name}}<br/>
                                                @endforeach
                                            </blockquote>
                                        @else
                                            没有任何权限<br/><br/>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        @else
                            请先添加角色
                        @endif
                    </div><!--col-lg-3-->
                </div>

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.user.index')}}" class="btn btn-danger btn-xs">取消</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="添加" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>

    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $(".show-permissions").click(function(e) {
                e.preventDefault();
                var $this = $(this);
                var role = $this.data('role');
                var permissions = $(".permission-list[data-role='"+role+"']");
                var hideText = $this.find('.hide-text');
                var showText = $this.find('.show-text');
                // console.log(permissions); // for debugging

                // show permission list
                permissions.toggleClass('hidden');

                // toggle the text Show/Hide for the link
                hideText.toggleClass('hidden');
                showText.toggleClass('hidden');
            });
        });
    </script>
@endsection