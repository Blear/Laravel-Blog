@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection
@section('page-header')
    <h1>
        页面管理
        <small>添加页面</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.page.store')}}" method="post">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">添加页面</h3>

                <div class="box-tools pull-right">
                    @include('backend.article.includes.article-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">标题</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="标题" name="title" value="{{old('title')}}" id="name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-lg-2 control-label">slug</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="slug" name="slug" value="{{old('slug')}}" id="slug" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content_original" class="col-lg-2 control-label">正文</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="content_original" id="content_original" rows="20" placeholder="请使用 Markdown 格式书写">{{old('content_original')}}</textarea>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.page.index')}}" class="btn btn-danger btn-xs">取消</a>
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
    <script src="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script>
        $(document).ready(function () {
            var simplemde = new SimpleMDE({
                autoDownloadFontAwesome: true,
                element: document.getElementById("content_original"),
                autosave: {
                    enabled: true,
                    uniqueId: "page.create",
                    delay: 1000,
                },
                renderingConfig: {
                    codeSyntaxHighlighting: true,
                },
                spellChecker: false,
                toolbar: ["bold", "italic", "heading", "|", "quote", 'code', 'ordered-list', 'unordered-list', 'link', 'image', 'table', '|', 'preview'],
            });

            inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
                uploadUrl: '{{route('admin.upload')}}',
                uploadFieldName: 'file',
                allowedTypes: [
                    'image/jpeg',
                    'image/png',
                    'image/jpg',
                    'image/gif'
                ],
                extraParams: {
                    '_token': '{{csrf_token()}}',
                },
            });

        });
        $("#tags").select2({
            tags: true
        });
    </script>
@endsection
