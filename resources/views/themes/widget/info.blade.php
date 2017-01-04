<div class="widget">
    <div class="widget-head"><li class="fa fa-user"></li>博主</div>
    <div class="widget-body">
        <div class="infomation">
            <div class="avatar">
                <a href="/"><img src="{{$avatar or asset('themes/images/avatar.png')}}" width="80px" height="80px" class="img-circle"></a>
            </div>
            <h4>{{$nickname or 'Blear'}}</h4>
            <p>{{$signature or 'We Start Then With Nothing...'}}</p>
            <div class="clearfix"></div>
            <div class="info-link">
                <ul>
                    <li><a class="fa fa-weibo fa-fw fa-lg" href="{{$weibo or '###'}}" target="_blank"></a></li>
                    <li><a class="fa fa-facebook fa-fw fa-lg" href="{{$facebook or '###'}}" target="_blank"></a></li>
                    <li><a class="fa fa-twitter fa-fw fa-lg" href="{{$twitter or '###'}}" target="_blank"></a></li>
                    <li><a class="fa fa-github fa-fw fa-lg" href="{{$github or '###'}}" target="_blank"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>