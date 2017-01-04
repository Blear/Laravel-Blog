<div class="widget">
    <div class="widget-head"><li class="fa fa-tag"></li>文章标签</div>
    <div class="widget-body">
        <div class="widget-content">
            	<span class="tags-links">
                @foreach($tags as $tag)
                <a rel="tag" href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
                @endforeach
                </span>
        </div>
    </div>
</div>