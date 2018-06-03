@extends('home.common.layout')
@section('header')
    <div class="wrapper bgded overlay" style="background-image:url('{{asset('assets/images/backgrounds/01.png')}}');">
        <div id="breadcrumb" class="hoc clear">
            <ul>
                <li><a href="{{route('index')}}">首页</a></li>
                @if(!empty($article->category->parent))
                    <li><a href="{{route('articleEnroll',$article->category->parent->id)}}">{{$article->category->parent->name}}</a></li>
                @endif
                <li><a href="{{route('articleEnroll',$article->category->id)}}">{{$article->category->name}}</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- 内容 -->
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content three_quarter first">
                <h1>{{$article->title}}</h1>
                {!! $article->content !!}

                <!-- 评论 -->
                <div id="comments">
                    <h2>评论</h2>
                    <ul>
                        <li>
                            @foreach($article->comments as $key=>$comment)
                                <article>
                                    <header>
                                        <figure class="avatar"><img src="{{asset('assets/images/avatar.png')}}" alt=""></figure>
                                        <address>
                                            By <a href="#">{{$comment->name}}</a>
                                        </address>
                                        <time datetime="{{$comment->created_at}}">{{$comment->created_at}}</time>
                                    </header>
                                    <div class="comcont">
                                        <p>
                                            {{$comment->content}}
                                        </p>
                                    </div>
                                </article>
                            @endforeach
                        </li>
                    </ul>

                    <!-- 评论表单 -->
                    <h2>提交评论</h2>
                    <form action="{{route('comment')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="article_id" value="{{$article->id}}" required>
                        <div class="one_third first">
                            <label for="name">姓名 <span>*</span></label>
                            <input type="text" autocomplete="name" name="name" id="name" value="" size="22" required>
                        </div>
                        <div class="one_third">
                            <label for="email">邮箱 <span>*</span></label>
                            <input type="email" autocomplete="email" name="email" id="email" value="" size="22" required>
                        </div>
                        <div class="block clear">
                            <label for="content">内容<span>*</span></label>
                            <textarea name="content" autocomplete="content" id="content" cols="25" rows="10"></textarea>
                        </div>
                        <div>
                            <input type="submit" value="提交">
                            <input type="reset" value="重置">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="sidebar one_quarter">
                <h6>相关信息</h6>
                <nav class="sdb_holder">
                    <ul>
                        @foreach($relatedArticles as $article)
                            <li>
                                <a href="{{route('article',$article->id)}}">{{$article->title}}</a><br>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="clear"></div>
        </main>
    </div>
    </body>
    <script>
        function iFrameHeight(id) {
            var ifm= document.getElementById(id);
            var subWeb = document.frames ? document.frames[id].document :ifm.contentDocument;
            if(ifm != null && subWeb != null) {
                ifm.height = subWeb.body.scrollHeight;
            }
        }
    </script>
    <script>
        $('#{{!empty($article->category->parent)?'category'.$article->category->parent->id:'category'.$article->category->id}}').addClass('active');
    </script>
@endsection
