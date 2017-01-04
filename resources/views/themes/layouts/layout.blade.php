<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title') {{ $web_name or '' }}</title>
<meta name="keywords" content="@yield('keywords') {{ $web_keywords or '' }}">
<meta name="description" content="@yield('description') {{ $web_description or '' }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{cdn(elixir('css/frontend.css'))}}" rel="stylesheet">
@yield('css')
</head>

<body>
@include('themes.layouts.header')
@yield('content')
@include('themes.layouts.footer')
<script src="{{cdn(elixir('js/frontend.js'))}}"></script>
@yield('script')
</body>
</html>
