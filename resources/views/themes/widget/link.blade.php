<div class="widget">
    <div class="widget-head"><li class="fa fa-link"></li>友情链接</div>
    <div class="widget-body">
        <div class="widget-content">
            @foreach($links as $link)
            <a href="{{$link->href}}" target="_blank">{{$link->name}}</a>
            @endforeach
        </div>
    </div>
</div>