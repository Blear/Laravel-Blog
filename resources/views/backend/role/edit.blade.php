@extends('backend.layouts.app')

@section('page-header')
    <h1>
        角色管理
        <small>角色编辑</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.role.update',$role)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">角色编辑</h3>

                <div class="box-tools pull-right">
                    @include('backend.role.includes.role-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-lg-2 control-label">角色名</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="角色名" name="name" value="{{$role->name}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="associated-permissions" class="col-lg-2 control-label">权限</label>
                    <div class="col-lg-10">
                        @if ($role->id != 1)
                        <select class="form-control" id="associated-permissions" name="associated-permissions">
                            <option value="all" {{$role->all?'selected="selected"':''}}>全局</option>
                            <option value="custom" {{$role->all?'':'selected="selected"'}}>自定义</option>
                        </select>
                        @else
                            <span class="label label-success">全局</span>
                        @endif
                        <div id="available-permissions" class="mt-20 hidden">
                            <div class="row">
                                <div class="col-xs-12">
                                    @if ($permissions->count())
                                        @foreach ($permissions as $perm)
                                            <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $role_permissions) ? 'checked' : '') }} />
                                            <label for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label><br/>
                                        @endforeach
                                    @else
                                        <p>该角色没有任何可用的权限</p>
                                    @endif
                                </div><!--col-lg-6-->
                            </div><!--row-->
                        </div><!--available permissions-->

                    </div>
                </div>
                <div class="form-group">
                    <label for="sort" class="col-lg-2 control-label">排序</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="排序" name="sort" value="{{$role->sort}}" id="sort" type="text">
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.role.index')}}" class="btn btn-danger btn-xs">取消</a>
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
        var associated = $("select[name='associated-permissions']");
        var associated_container = $("#available-permissions");

        if (associated.val() == "custom")
            associated_container.removeClass('hidden');
        else
            associated_container.addClass('hidden');

        associated.change(function() {
            if ($(this).val() == "custom")
                associated_container.removeClass('hidden');
            else
                associated_container.addClass('hidden');
        });
    </script>
@endsection