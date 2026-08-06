@extends('site.layouts.master')
@section('content')
<!-- Start Page header -->
<div class="page-header parallax" style="background-image:url({{request()->root()}}/public/autostars/images/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
	<div class="container">
			<h1 class="page-title">@lang('site.contactUs')</h1>
		</div>
</div>
<!-- Utiity Bar -->
<div class="utility-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-6 col-xs-8">
				<ol class="breadcrumb">
					<li><a href="{{request()->root()}}/">@lang('site.home')</a></li>
					<li class="active">@lang('site.contactUs')</li>
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
				<div class="container">

					<div class="row">
						<div class="col-md-6">
							<h3 class="mb-sm mt-sm">@lang('site.location')</h3>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d960.7128990075518!2d32.51848526076365!3d15.599575910177993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x168e8e126db7d1c1%3A0x4a96944150b4ae7e!2sAl-Faihaa+Building!5e0!3m2!1sen!2s!4v1535265848900" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
						<div class="col-md-6">

							<h3 class="heading-primary">@lang('site.address')</h3>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>@lang('site.address'):</strong> @lang('site.addressLine1')</li>
								<li><i class="fa fa-phone"></i> <strong>@lang('site.phone'):</strong> <span dir="ltr">+249 (183) 781623, +249 (183) 781759 </span></li>
								<li><i class="fa fa-envelope"></i> <strong>@lang('site.email'):</strong> <a href="mailto:info@itsco.sd">info@itsco.sd</a></li>
							</ul>

							<hr>

							<h3 class="heading-primary">@lang('site.workingHours')</h3>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> @lang('site.workingHoursLine1')</li>
								<li><i class="fa fa-clock-o"></i> @lang('site.workingHoursLine2')</li>
							</ul>

						</div>

					</div>

				</div>

			</div>
</div>

@stop

@section('scripts')
		<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTQgPrZgWBnnT822P0FRfEq1T4e0PWGkM"></script> -->
		<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			// // Map Markers
			// var mapMarkers = [{
			// 	address: "السودان - الخرطوم - شارع علي عبد اللطيف",
			// 	html: "<strong>شركة الفيصل للأوراق المالية المحدودة</strong><br> عمارة الفيحاء - الطابق الثالث",
			// 	icon: {
			// 		image: "{{request()->root()}}/public/assets/porto/img/pin.png",
			// 		iconsize: [46, 46],
			// 		iconanchor: [12, 46]
			// 	},
			// 	popup: true
			// }];
			//
			// // Map Initial Location
			// var initLatitude = 15.551690;
			// var initLongitude = 32.551564;
			//
			// // Map Extended Settings
			// var mapSettings = {
			// 	controls: {
			// 		panControl: true,
			// 		zoomControl: true,
			// 		mapTypeControl: true,
			// 		scaleControl: true,
			// 		streetViewControl: true,
			// 		overviewMapControl: true
			// 	},
			// 	scrollwheel: false,
			// 	markers: mapMarkers,
			// 	latitude: initLatitude,
			// 	longitude: initLongitude,
			// 	zoom: 16
			// };
			//
			// var map = $('#googlemaps').gMap(mapSettings);
			//
			// // Map Center At
			// var mapCenterAt = function(options, e) {
			// 	e.preventDefault();
			// 	$('#googlemaps').gMap("centerAt", options);
			// }

		</script>

@stop
