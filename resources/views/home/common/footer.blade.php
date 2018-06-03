<!-- 脚注 -->
<div class="wrapper row4">
    <footer id="footer" class="hoc clear">
        <div class="one_quarter first">
            <ul class="nospace btmspace-30 linklist contact">
                <li>
                    <i class="fa fa-map-marker"></i>
                    <address>
                        {{config('ower_address')}}
                    </address>
                </li>
                <li><i class="fa fa-phone"></i> {{config('ower_phone')}}</li>
                <li><i class="fa fa-envelope-o"></i> {{config('ower_email')}}</li>
            </ul>
        </div>
        <div class="one_quarter btmspace-30">

            <ul class="nospace linklist">
                @foreach($navs as $key=>$nav)
                    @if(empty($nav->parent))
                        <li id="category{{$nav->id}}">
                            <a href="{{route('articleEnroll',$nav->id)}}">{{$nav->name}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="one_quarter">
            <p class="nospace btmspace-15">需要更多信息可以留言联系</p>
            <form method="post" action="{{route('contact')}}">
                <fieldset>
                    {{csrf_field()}}
                    <input class="btmspace-15" type="text" autocomplete="name" name="name" value="" placeholder="姓名" required>
                    <input class="btmspace-15" type="email" autocomplete="email" name="email" value="" placeholder="邮箱" required>
                    <textarea
                            class="btmspace-15"
                            rows="4"
                            name="content"
                            cols="30"
                            style="background-color: #333333;border-color: #333333"
                            autocomplete="content"
                            placeholder="请输入留言内容" required></textarea>
                    <button type="submit" value="submit">提交</button>
                </fieldset>
            </form>
        </div>
    </footer>
</div>

<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="{{route('index')}}">{{config('project_name')}}</a></p>
    </div>
</div>
<!-- 返回顶部 -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>

