@extends('site.layouts.master')
@section('content')
	    <!-- Start Page header -->
	    <div class="page-header parallax" style="background-image:url({{request()->root()}}/public/autostars/images/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
			<div class="container">
				<h1 class="page-title">@lang('site.services')</h1>
			   </div>
		</div>
		<!-- Utiity Bar -->
		<div class="utility-bar">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-sm-6 col-xs-8">
						<ol class="breadcrumb">
								<li><a href="{{request()->root()}}/">@lang('site.home')</a></li>
								<li class="active">@lang('site.aboutUs')</li>
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
			{{--  <div class="container">
                <!-- Recently Listed Vehicles -->
                <section class="listing-block recent-vehicles">
						<div class="listing-container">
							<div class="carousel-wrapper">
								<div class="row">
									<ul class="owl-carousel carousel-fw" id="vehicle-slider" data-columns="2" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="4" data-items-desktop-small="3" data-items-tablet="2" data-items-mobile="1">
										@foreach($services as $service)
											<li class="item">
												<div class="vehicle-block format-standard">
													<a href="vehicle-details.html" class="media-box"><img src="{{$service->getImage()}}" alt=""></a>
													<div class="vehicle-block-content">
														<span class="label label-default vehicle-age">2014</span>
														<span class="label label-success premium-listing">Premium Listing</span>
														<h5 class="vehicle-title"><a href="{{request()->root()}}/services/{{$service->id}}">@lang('site.getContent', ['ar'=>$service->name, 'en'=>$service->nameEn ])</a></h5>
														<span class="vehicle-meta">@lang('site.getContent', ['ar'=>Str::words(strip_tags($service->txt),30), 'en'=>Str::words(strip_tags($service->txtEn),30)])</span>
														<a href="results-list.html" title="View all Sedans" class="vehicle-body-type">@lang('site.readMore')</a>
													</div>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					</section>
			</div>  --}}
    <!-- Start Body Content -->
	<div class="main" role="main">
			<div id="content" class="content full">
				<div class="container">
					  <div class="row">
						<div class="col-md-12 posts-archive">
							@foreach($services as $service)
							  <article class="post format-standard col-md-6 col-sm-6">
								<div class="row">
									  <div class="col-md-12 col-sm-12">
											<h3 class="post-title"><a href="{{request()->root()}}/services/{{$service->id}}">@lang('site.getContent', ['ar'=>$service->name, 'en'=>$service->nameEn ])</a></h3>
											<a href="{{request()->root()}}/services/{{$service->id}}"><img src="{{$service->getImage()}}" alt="" class="img-responsive"></a>
											<!-- <p>@lang('site.getContent', ['ar'=>Str::words(strip_tags($service->txt),30), 'en'=>Str::words(strip_tags($service->txtEn),30)])</p> -->
									  </div>
								</div>
							  </article>
							@endforeach
						</div>
					  </div>
				</div>
		   </div>
	</div>
		<!-- End Body Content -->




			</div>

@stop
