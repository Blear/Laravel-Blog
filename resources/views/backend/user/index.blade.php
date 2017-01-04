@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{cdn(elixir('plugins/backend/datatables/css/dataTables.bootstrap.min.css'))}}">
@endsection

@section('page-header')
    <h1>
        用户管理
        <small>用户列表</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">用户管理</h3>

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
                        <th>创建日期</th>
                        <th>修改日期</th>
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
                    data: {status: 1, trashed: false,_token:'{{csrf_token()}}'}
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
        });
    </script>
@endsection