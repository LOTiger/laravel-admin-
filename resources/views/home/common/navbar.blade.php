<div class="wrapper row2">
    <nav id="mainav" class="hoc clear">
        <ul class="clear">

            <li id="home">
                <a href="{{route('index')}}">首页</a>
            </li>

            @foreach($navs as $key=>$nav)
                @if(empty($nav->parent))
                    @if(!$nav->children->isEmpty())
                        <li id="category{{$nav->id}}">
                            <a class="drop" href="#">{{$nav->name}}</a>
                            <ul>
                                @foreach($nav->children as $k=>$child)
                                    <li><a href="{{route('articleEnroll',$child->id)}}">{{$child->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li id="category{{$nav->id}}">
                            <a href="{{route('articleEnroll',$nav->id)}}">{{$nav->name}}</a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </nav>
</div>