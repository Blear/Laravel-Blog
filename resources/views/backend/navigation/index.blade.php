@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{cdn(elixir('plugins/backend/datatables/css/dataTables.bootstrap.min.css'))}}">
@endsection

@section('page-header')
    <h1>
        导航管理
        <small>导航列表</small>
    </h1>
@endsection
@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">导航管理</h3>

            <div class="box-tools pull-right">
                @include('backend.navigation.includes.navigation-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="navigations-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>导航名称</th>
                        <th>连接</th>
                        <th>排序</th>
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
            $('#navigations-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.navigation.get") }}',
                    type: 'post',
                    data: {_token:'{{csrf_token()}}'}
                },
                columns: [
                    {data: 'name', name: 'navigations.name', render: $.fn.dataTable.render.text()},
                    {data: 'href', name: 'navigations.href'},
                    {data: 'sort', name: 'navigations.sort'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
            $("body").on("click", "a[name='delete']", function(e) {
                e.preventDefault();
                swal({
                    title: "你确定要执行这个操作吗?",
                    text: "你确定要删除此记录吗？",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确认",
                    cancelButtonText: "取消",
                    closeOnConfirm: false
                }, function(isConfirmed){
                    if (isConfirmed){
                        $(e.target).find('form').submit();
                    }
                });
            });
        });
    </script>
@endsection