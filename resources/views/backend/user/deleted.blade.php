@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{cdn(elixir('plugins/backend/datatables/css/dataTables.bootstrap.min.css'))}}">
@endsection

@section('page-header')
    <h1>
        用户管理
        <small>已删除的用户</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">已删除的用户</h3>

            <div class="box-tools pull-right">
                @include('backend.user.includes.user-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>角色</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('js')
    <script src="{{cdn(elixir('plugins/backend/datatables/js/jquery.dataTables.min.js'))}}"></script>
    <script src="{{cdn(elixir('plugins/backend/datatables/js/dataTables.bootstrap.min.js'))}}"></script>
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.user.get") }}',
                    type: 'post',
                    data: {status: false, trashed: true,_token:'{{csrf_token()}}'}
                },
                columns: [
                    {data: 'id', name: 'users.id'},
                    {data: 'name', name: 'users.name', render: $.fn.dataTable.render.text()},
                    {data: 'email', name: 'users.email', render: $.fn.dataTable.render.text()},
                    {data: 'roles', name: 'roles.name'},
                    {data: 'created_at', name: 'users.created_at'},
                    {data: 'updated_at', name: 'users.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}

                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
            $("body").on("click", "a[name='delete_user_perm']", function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");

                swal({
                    title: "你确定要执行这个操作吗?",
                    text: "你确定要删除此用户吗？此操作不可恢复.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false
                }, function(isConfirmed){
                    if (isConfirmed){
                        window.location.href = linkURL;
                    }
                });
            });

            $("body").on("click", "a[name='restore_user']", function(e) {
                e.preventDefault();
                var linkURL = $(this).attr("href");

                swal({
                    title: "你确定要执行这个操作吗?",
                    text: "恢复此用户?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false
                }, function(isConfirmed){
                    if (isConfirmed){
                        window.location.href = linkURL;
                    }
                });
            });
        });
    </script>
@endsection