@extends('site.layouts.master')

@section('og')
    <meta property="og:title" content="{{ $news->title }}">
    <meta property="og:description" content="{{ $news->txt }}">
    <meta property="og:url" content="{{ $news->getUrl() }}">
    <meta property="og:image" content="{{ $news->getPicture() }}">
    
    <meta name="twitter:title" content="{{ $news->title }} ">
    <meta name="twitter:description" content=" {{  $news->txt  }}">
    <meta name="twitter:card" content="{{ $news->getUrl() }}">
    <meta name="twitter:image" content="{{ $news->getPicture() }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
            <li><a href="{{ url('/') }}/news">@lang('site.news')</a></li>
            <li><a class="active">@lang('site.getContent',['ar'=>$news->title, 'en'=>$news->titleEn])</a></li>
        </ol>
    </div>
    <!-- end Breadcrumb -->

	<!-- Page Content -->
	<div id="page-content">
		<div class="container">
			<div class="row">
				<!--MAIN Content-->
				<div class="col-md-8">
					<div id="page-main">
						<section id="blog-detail">
							<header><h1>{{ $news->trans('title','titleEn') }}</h1></header>
							<article class="blog-detail">
								<header class="blog-detail-header">
									<img src="{{ $news->getPicture() }}" class="thumbnail img-responsive center-block">
									<h2>{{ $news->trans('title','titleEn') }}</h2>
									<div class="blog-detail-meta">
										<span class="date"><span class="fa fa-file-o"></span>{{ date("Y-m-d",strtotime($news->news_date)) }}</span>
										<span class="comments"><span class="fa fa-eye"></span>{{ number_format($news->readingCount) }} {{ trans_choice('site.views',$news->readingCount) }}</span>
									</div>
								</header>
								<hr>
								<p>{!! $news->trans('txt','txtEn') !!}</p>
								<footer>
									<section id="share-post">
										<div class="icons">
											<span>@lang('site.share'):</span>
											<a href=""><i class="fa fa-twitter"></i></a>
											<a href="https://www.facebook.com/sharer/sharer.php?u={{ $news->getUrl() }}"><i class="fa fa-facebook"></i></a>
											<a href=""><i class="fa fa-pinterest"></i></a>
											<a href=""><i class="fa fa-youtube-play"></i></a>
										</div><!-- /.icons -->
									</section><!-- /share -->
									{{-- <hr> --}}
									{{-- <section id="tags">
										<a href="#" class="tag">Design</a>
										<a href="#" class="tag">Technology</a>
										<a href="#" class="tag">Science</a>
										<a href="#" class="tag">Art</a>
									</section><!-- /tags --> --}}
								</footer>
							</article>
						</section><!-- /.blog-detail -->

						<hr>

					</div><!-- /#page-main -->
				</div><!-- /.col-md-8 -->

				<!--SIDEBAR Content-->
				<div class="col-md-4">
					<div id="page-sidebar" class="sidebar">
						@include('site.newsMenu')
					</div><!-- /#sidebar -->
				</div><!-- /.col-md-4 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div>
	<!-- end Page Content -->
@stop