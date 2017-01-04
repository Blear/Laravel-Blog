<header id="header">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">导航条</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ url('/') }}">
                    <div class="navbar-brand">Blog</div>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-navbar-collapse">
                <ul class="nav navbar-nav top-navbar-nav">
                    @foreach($navigations as $navigation)
                        <li><a title="{{$navigation->name}}" href="{{$navigation->href}}" target="{{$navigation->target}}">{{$navigation->name}}</a> </li>
                    @endforeach
                </ul>
                <form id="searchform" class="navbar-form navbar-right" role="search"  method="get" action="{{route('article.search')}}">
                    <div class="form-group">
                        <input type="text" id="keyword" name="keyword" class="form-control" data-provide="typeahead" autocomplete="off" placeholder="请输入要搜索关键词">
                    </div>
                    <button type="submit" class="btn"  id="searchbtn"> 搜索 </button>
                </form>
            </div>
        </div>
    </nav>
</header>