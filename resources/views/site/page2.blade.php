@extends('site.layouts.master')
@section('content')
<section class="my-breadcrumb">
    <div class="container page-banner">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <h1>@lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">@lang('site.home')</a></li>
                    <li><a href="">@lang('site.aboutUs')</a></li>
                    <li class="active">@lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="blog-posts">
    <div class="container">
        <div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<aside>
					@include('site.subMenu')
				</aside>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="row">
					<p>{!! $page->txt !!}</p>
				</div>
			</div>
		</div>
	</div>
</section>

@stop