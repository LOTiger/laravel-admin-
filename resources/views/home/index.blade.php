@extends('home.common.layout')
@section('content')
	<!-- 简介 -->
	<div class="wrapper row3">
		<main class="hoc container clear" style="padding-bottom: 0px;">
			<article class="group">
				<div class="group">
					<div class="one_quarter first">
						<h6 class="heading">{{config('project_name')."简介"}}</h6>
					</div>
					<div class="three_quarter">
						<p>
							{{config('simple_introduce')}}
						</p>
						<footer><a class="btn" href="{{config('project_introduce_route')}}">查看更多&raquo;</a></footer>
					</div>
				</div>
			</article>
		</main>
	</div>

	<!-- 动态 -->
	<div class="wrapper row3">
		<section class="hoc container clear">
			<div class="sectiontitle">
				<h6 class="heading">最新动态</h6>
			</div>
			<div class="group">
				@foreach($resent as $key => $item)
					<article class="one_third btmspace-30 {{$key%3==0?"first":""}}">
						<a href="{{route('article',$item->id)}}">
							<img class="btmspace-30" src="{{asset('uploads/'.$item->image)}}" alt="">
						</a>
						<h6 class="nospace heading">{{$item->title}}</h6>
						<ul class="nospace meta">
							<li><i class="fa fa-tag"></i> <a href="{{route('articleEnroll',$item->category->id)}}">{{$item->category->name}}</a></li>

							<li><i class="fa fa-clock-o"></i> <time datetime="{{date('Y-m-d', strtotime($item->created_at))}}">
										{{date('y年m月d日', strtotime($item->created_at))}}</time></li>
						</ul>
						<p>{!!str_limit(strip_tags(htmlspecialchars_decode($item->content)) ,20,'...')!!}&hellip;</p>
						<footer class="nospace">
							<a class="btn" href="{{route('article',$item->id)}}">查看详情</a>
						</footer>
					</article>
				@endforeach

			</div>
		</section>
	</div>
	<script>
        $('#home').addClass('active');
	</script>
@endsection
