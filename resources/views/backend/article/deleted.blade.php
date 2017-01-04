@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{cdn(elixir('plugins/backend/datatables/css/dataTables.bootstrap.min.css'))}}">
@endsection

@section('page-header')
    <h1>
        文章管理
        <small>回收站</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">回收站</h3>

            <div class="box-tools pull-right">
                @include('backend.article.includes.article-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="articles-table" class="table table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th>标签</th>
                        <th>发布日期</th>
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
            $('#articles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.article.get") }}',
                    type: 'post',
                    data: { trashed: true,_token:'{{csrf_token()}}'}
                },
                columns: [
                    {data: 'title', name: 'articles.title', render: $.fn.dataTable.render.text()},
                    {data: 'user', name: 'users.name', render: $.fn.dataTable.render.text()},
                    {data: 'category', name: 'categories.name', sortable: false},
                    {data: 'tags', name: 'tags.name', sortable: false},
                    {data: 'published_at', name: 'articles.published_at'},
                    {data: 'updated_at', name: 'articles.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}

                ],

                searchDelay: 500
            });
        });
        $("body").on("click", "a[name='delete_user_perm']", function(e) {
            e.preventDefault();
            var linkURL = $(this).attr("href");

            swal({
                title: "你确定要执行这个操作吗?",
                text: "你确定要删除此文章吗？此操作不可恢复.",
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
                text: "恢复此文章?",
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
    </script>
@endsection