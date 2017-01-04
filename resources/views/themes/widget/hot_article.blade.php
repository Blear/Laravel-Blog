<div class="widget">
    <div class="widget-head"><li class="fa fa-fire"></li>热门文章</div>
    <div class="widget-body">
        <ul class="list-group">
            @foreach($hotarticles as $article)
            <li class="list-item"><a href="{{route('article.show',$article->slug)}}"><span class="title">{{$article->title}}</span><span class="badge">{{$article->view}}</span></a></li>
            @endforeach
        </ul>
    </div>
</div>