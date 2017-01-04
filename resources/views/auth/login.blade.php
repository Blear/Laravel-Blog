@extends('layouts.app')
@section('title','博客管理 | 登陆')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/login')}}"><b>博客管理</b></a>
        </div>
        @include('backend.includes.messages')
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">请输入您的管理员账号密码</p>

            <form method="POST" action="{{ url('/login') }}">
                {{csrf_field()}}
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> 记住我
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            <a href="{{ url('/password/reset') }}">忘记密码?</a><br>
            {{--<a href="register.html" class="text-center">Register a new membership</a>--}}

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection
@section('js')
<!-- iCheck -->
<script src="{{asset('plugins/backend/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endsection
