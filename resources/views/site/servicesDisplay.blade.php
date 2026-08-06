@extends('site.layouts.master')
@section('content')
<!-- Start Page header -->
<div class="page-header parallax" style="background-image:url({{request()->root()}}/public/autostars/images/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
<div class="container">
	<h1 class="page-title">@lang('site.getContent',['ar'=>$service->name, 'en'=>$service->nameEn])</h1>
	 </div>
</div>
<!-- Utiity Bar -->
<div class="utility-bar">
<div class="container">
	<div class="row">
		<div class="col-md-8 col-sm-6 col-xs-8">
			<ol class="breadcrumb">
					<li><a href="{{request()->root()}}/">@lang('site.home')</a></li>
					<li><a href="{{request()->root()}}/services">@lang('site.services')</a></li>
					<li class="active">@lang('site.getContent',['ar'=>$service->name, 'en'=>$service->nameEn])</li>
			</ol>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-4">
			<ul class="utility-icons social-icons social-icons-colored">
				@include('site.utilityBarLeft')
			</ul>
		</div>
	</div>
	</div>
</div>


<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
		<section class="blog-posts">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<h3>@lang('site.getContent',['ar'=>$service->name, 'en'=>$service->nameEn])</h3>
						<img src="{{$service->getImage()}}" style="margin-bottom: 25px;" class="img-responsive" />
						<p>@lang('site.getContent',['ar'=>$service->txt, 'en'=>$service->txtEn])</p>
					</div>
					<div class="col-md-3 col-sm-12 col-xs-12">
						<aside class="sidebar">
							<div class="widget">
								<!--Recent Posts heading-->
								<h3 class="heading-primary">@lang('site.services')</h3>
								<!--end Recent Posts-->
								<!--Instagram section-->
								<table class="table table-hover table-bordered">
									<?php $services = App\Service::orderBy('id')->get(); ?>
									@foreach($services as $s)
										<tr><td><i class="fa fa-circle-o"></i></td><td><a href="{{$s->getLink()}}">@lang('site.getContent',['ar'=>$s->name, 'en'=>$s->nameEn])</a></td></tr>
									@endforeach
								</table>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</scetion>
	</div>
</div>
@stop
