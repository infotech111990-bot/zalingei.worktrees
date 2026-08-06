@extends('site.layouts.master')
@section('content')
<section class="my-breadcrumb">
<div class="container page-banner">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-xs-12">
			<h1>@lang('site.eServices')</h1>
			<ol class="breadcrumb">
				<li><a href="index.html">@lang('site.home')</a></li>
				<li><a href="">@lang('site.aboutUs')</a></li>
				<li class="active">@lang('site.eBankingServices')</li>
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
				<div class="widget">
					<!--Recent Posts heading-->
					<h4>@lang('site.eBankingServices')</h4>
					<!--end Recent Posts--> 
					<!--Instagram section-->
					<ul class="categories-module">
						<?php $services = App\Service::all(); ?>
						@foreach($services as $s)
							<li><a href="{{$s->getLink()}}">{!! $s->name !!}</a></li>
						@endforeach
					</ul>
				</div>
			</aside>
		</div>
		<div class="col-md-8 col-sm-12 col-xs-12">
		<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 heading">
					<span class="heading-letter-style">@lang('site.pioneers')</span>
					<div class="main-heading-container">
						<h3>@lang('site.aboutUs')</h3>
						<h1>@lang('site.eBankingServices')</h1>
					</div>
				</div>
				@foreach($services as $service)
					<div class="col-md-6 col-xs-12 col-sm-6">
					<div class="services-grid-3">
						<a href="{{$service->getLink()}}">
							<img src="{{$service->getIcon()}}" class="img-responsive" alt="">
							<div class="content-area">
								<h4>@lang('site.getContent', ['ar'=>$service->name, 'en'=>$service->nameEn ])</h4>
								<p>@lang('site.getContent', ['ar'=>Str::words(strip_tags($service->txt),15), 'en'=>Str::words(strip_tags($service->txtEn),10)])</p>
							</div>
						</a>
						<div class="img-icon-bg">
							<img src="{{$service->getIcon()}}" class="img-responsive" alt="">
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	</div>

@stop