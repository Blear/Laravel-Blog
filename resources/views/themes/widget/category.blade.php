<div class="widget">
    <div class="widget-head"><li class="fa fa-folder-o"></li>文章分类</div>
    <div class="widget-body">
        <div class="widget-content">
            @foreach($categories as $category)
            <a href="{{route('category.show',$category->slug)}}">{{$category->name}} <span class="badge">{{$category->articles_count}}</span></a>
            @endforeach
        </div>
    </div>
</div>