@extends('backend.layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link href="//cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
@endsection
@section('page-header')
    <h1>
        网站配置
        <small>网站配置</small>
    </h1>
@endsection

@section('content')
    <form class="form-horizontal" action="{{route('admin.setting')}}" method="post">
        {{csrf_field()}}
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">网站配置</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    <label for="web_name" class="col-lg-2 control-label">博客标题</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="博客标题" name="web_name" value="{{isset($web_name)?$web_name:old('web_name')}}" id="web_name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="web_description" class="col-lg-2 control-label">博客描述</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="4" placeholder="博客描述" name="web_description"  id="web_description">{{isset($web_description)?$web_description:old('web_description')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="web_keywords" class="col-lg-2 control-label">博客关键字</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="博客关键字" name="web_keywords" value="{{isset($web_keywords)?$web_keywords:old('web_keywords')}}" id="web_keywords" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" class="col-lg-2 control-label">头像</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="头像url" name="avatar" value="{{isset($avatar)?$avatar:old('avatar')}}" id="avatar" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">博主网名</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="博主网名" name="nickname" value="{{isset($nickname)?$nickname:old('nickname')}}" id="nickname" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="signature" class="col-lg-2 control-label">自我介绍</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="自我介绍" name="signature" value="{{isset($signature)?$signature:old('signature')}}" id="signature" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="appid" class="col-lg-2 control-label">畅言appid</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="畅言appid" name="appid" value="{{isset($appid)?$appid:old('appid')}}" id="appid" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="conf" class="col-lg-2 control-label">畅言conf</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="畅言conf" name="conf" value="{{isset($conf)?$conf:old('conf')}}" id="conf" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="weibo" class="col-lg-2 control-label">微博链接</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="微博链接" name="weibo" value="{{isset($weibo)?$weibo:old('weibo')}}" id="weibo" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="facebook" class="col-lg-2 control-label">FaceBook链接</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="FaceBook链接" name="facebook" value="{{isset($facebook)?$facebook:old('facebook')}}" id="facebook" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="twitter" class="col-lg-2 control-label">Twiter链接</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="Twiter链接" name="twitter" value="{{isset($twitter)?$twitter:old('twitter')}}" id="twitter" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="github" class="col-lg-2 control-label">Github链接</label>
                    <div class="col-lg-10">
                        <input class="form-control" placeholder="Github链接" name="github" value="{{isset($github)?$github:old('github')}}" id="github" type="text">
                    </div>
                </div>

            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    <a href="{{route('admin.home')}}" class="btn btn-danger btn-xs">返回管理主页</a>
                </div><!--pull-left-->

                <div class="pull-right">
                    <input class="btn btn-success btn-xs" value="保存" type="submit">
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div>

    </form>
@endsection
@section('js')
    <script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script src="{{asset('plugins/backend/InlineAttachment/codemirror-4.inline-attachment.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var simplemde = new SimpleMDE({
                autoDownloadFontAwesome: true,
                element: document.getElementById("content_original"),
                autosave: {
                    enabled: false,
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
