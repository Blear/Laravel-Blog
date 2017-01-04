@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{cdn(elixir('plugins/backend/datatables/css/dataTables.bootstrap.min.css'))}}">
@endsection

@section('page-header')
    <h1>
        文章管理
        <small>文章列表</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">文章管理</h3>

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
                    data: {status: 1, trashed: false,_token:'{{csrf_token()}}'}
                },
                columns: [
                    {data: 'title', name: 'articles.title', render: $.fn.dataTable.render.text()},
                    {data: 'user', name: 'user.name', sortable: false},
                    {data: 'category', name: 'category.name', sortable: false},
                    {data: 'tags', name: 'tags.name', sortable: false},
                    {data: 'published_at', name: 'articles.published_at'},
                    {data: 'updated_at', name: 'articles.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}

                ],
                order: [[4, "desc"]],
                searchDelay: 500
            });
        });

    </script>
@endsection