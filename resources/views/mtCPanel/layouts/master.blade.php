@section('php')
	
@show
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>@lang('site.siteName')</title>
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css2?family=Tajawal:wght@200;400&display=swap" rel="stylesheet">


		<!-- CORE CSS -->
		<link href="{{ asset('public/assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/plugins/bootstrap/RTL/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="{{ asset('public/assets/admin/css/essentials.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/css/layout.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/css/layout-RTL.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/css/color_scheme/blue.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
		
		<!-- Include one of jTable styles. -->
		<link href="{{Request::root()}}/public/assets/mtCPanel/jtable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<link href="{{Request::root()}}/public/assets/mtCPanel/jtable/themes/metro/lightgray/jtable.css" rel="stylesheet" type="text/css" />
		
		<!-- Dropzone styles. -->
		<link href="{{ asset('public/assets/admin/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
		

	</head>
	<!--
		.boxed = boxed version
	-->
	<body>


		<!-- WRAPPER -->
		<div id="wrapper" class="clearfix">

			<!-- 
				ASIDE 
				Keep it outside of #wrapper (responsive purpose)
			-->
			<aside id="aside">
				<!--
					Always open:
					<li class="active alays-open">

					LABELS:
						<span class="label label-danger pull-right">1</span>
						<span class="label label-default pull-right">1</span>
						<span class="label label-warning pull-right">1</span>
						<span class="label label-success pull-right">1</span>
						<span class="label label-info pull-right">1</span>
                -->
                @include('mtCPanel.sideBar')

				<span id="asidebg"><!-- aside fixed background --></span>
			</aside>
			<!-- /ASIDE -->


			<!-- HEADER -->
			<header id="header">

				<!-- Mobile Button -->
				<button id="mobileMenuBtn"></button>

				<!-- Logo -->
				<span class="logo pull-right">
					<img src="{{request()->root()}}/public/assets/admin/images/logo_light.png" alt="admin panel" height="35" />
				</span>

				<nav>

					<!-- OPTIONS LIST -->
					<ul class="nav pull-left">

						<!-- USER OPTIONS -->
						<li class="dropdown pull-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
								@if(isset(auth()->guard('admin')->user()->picture))
									<img class="user-avatar" alt="" src="{{ auth()->guard('admin')->user()->picture }}" height="34" /> 
								@else
									<img class="user-avatar" alt="" src="{{ request()->root() }}/public/assets/images/user.png" height="34" width="34" /> 
								@endif
								
								<span class="user-name">
									<span class="hidden-xs">
										{{ auth()->guard('admin')->user()->name }} <i class="fa fa-angle-down"></i>
                                    </span>
								</span>
							</a>
							<ul class="dropdown-menu hold-on-click">
								<li><!-- settings -->
									<a href="{{ request()->root() }}/userAccount/profile"><i class="fa fa-user"></i> البروفايل</a>
								</li>

								<li class="divider"></li>

								<li><!-- logout -->
									<form method="POST" action="{{ route('mtCPanel.logout') }}">
										@csrf
										<button type="submit" class="btn btn-link"><i class="fa fa-power-off"></i> تسجيل الخروج</button>
									</form>
								</li>
							</ul>
						</li>
						<!-- /USER OPTIONS -->

					</ul>
					<!-- /OPTIONS LIST -->

				</nav>

			</header>
			<!-- /HEADER -->


			<!-- 
				MIDDLE 
			-->
			<section id="middle">

                <!-- page title -->
				<header id="page-header">
					<h1>
                        @section('header-title') @show
                    </h1>
					<ol class="breadcrumb">
						@section('breadcrumb') @show
					</ol>
				</header>
				<!-- /page title -->


				<div id="content" class="dashboard padding-20">
                    @section('row-title') @show
                    @section('content')
                        
                    @show
				</div>
			</section>
			<!-- /MIDDLE -->

		</div>



	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '{{ request()->root() }}/public/assets/admin/plugins/';</script>
		<script type="text/javascript" src="{{ asset('public/assets/admin/plugins/jquery/jquery-2.2.3.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/admin/js/app.js') }}"></script>

		<script src="{{Request::root()}}/public/assets/mtCPanel/jtable/jquery-ui-1.10.0.min.js"></script>

		<!-- Include jTable script file. -->
		<script src="{{Request::root()}}/public/assets/mtCPanel/jtable/jquery.jtable.js" type="text/javascript"></script>
		<script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/jtable/localization/jquery.jtable.ar.js"></script>
		<script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/adapters/jquery.js"></script>
		<script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/bootstrap-ckeditor-fix.js"></script>

		<!-- Sweet Alert -->
		<script src="{{ asset('public/assets/sweetalert/js/sweetalert.all.js') }}"></script>

        <!-- PAGE LEVEL SCRIPT -->
        @if(auth()->guard('admin')->user()->unreadNotifications->count() > 0)
            <script type="text/javascript">
			    _toastr("لديك عدد {{ auth()->guard('admin')->user()->unreadNotifications->count() }} تنبيهات جديدة","top-left","success","{{ request()->root() }}/userAccount/notifications");
            </script>
        @endif
		<script type="text/javascript">
			/* 
				Toastr Notification On Load 

				TYPE:
					primary
					info
					error
					success
					warning

				POSITION
					top-right
					top-left
					top-center
					top-full-width
					bottom-right
					bottom-left
					bottom-center
					bottom-full-width
					
				false = click link (example: "http://www.stepofweb.com")
			*/
            




			/** SALES CHART
			******************************************* **/
			loadScript(plugin_path + "chart.flot/jquery.flot.min.js", function(){
				loadScript(plugin_path + "chart.flot/jquery.flot.resize.min.js", function(){
					loadScript(plugin_path + "chart.flot/jquery.flot.time.min.js", function(){
						loadScript(plugin_path + "chart.flot/jquery.flot.fillbetween.min.js", function(){
							loadScript(plugin_path + "chart.flot/jquery.flot.orderBars.min.js", function(){
								loadScript(plugin_path + "chart.flot/jquery.flot.pie.min.js", function(){
									loadScript(plugin_path + "chart.flot/jquery.flot.tooltip.min.js", function(){

										if (jQuery("#flot-sales").length > 0) {

											/* DEFAULTS FLOT COLORS */
											var $color_border_color = "#eaeaea",		/* light gray 	*/
												$color_second 		= "#5a6667";		/* blue      	*/


											var d = [
												[1196463600000, 0], [1196550000000, 0], [1196636400000, 0], [1196722800000, 77], [1196809200000, 3636], [1196895600000, 3575], [1196982000000, 2736], [1197068400000, 1086], [1197154800000, 676], [1197241200000, 1205], [1197327600000, 906], [1197414000000, 710], [1197500400000, 639], [1197586800000, 540], [1197673200000, 435], [1197759600000, 301], [1197846000000, 575], [1197932400000, 481], [1198018800000, 591], [1198105200000, 608], [1198191600000, 459], [1198278000000, 234], [1198364400000, 4568], [1198450800000, 686], [1198537200000, 4122], [1198623600000, 449], [1198710000000, 468], [1198796400000, 392], [1198882800000, 282], [1198969200000, 208], [1199055600000, 229], [1199142000000, 177], [1199228400000, 374], [1199314800000, 436], [1199401200000, 404], [1199487600000, 544], [1199574000000, 500], [1199660400000, 476], [1199746800000, 462], [1199833200000, 500], [1199919600000, 700], [1200006000000, 750], [1200092400000, 600], [1200178800000, 500], [1200265200000, 900], [1200351600000, 930], [1200438000000, 1200], [1200524400000, 980], [1200610800000, 950], [1200697200000, 900], [1200783600000, 1000], [1200870000000, 1050], [1200956400000, 1150], [1201042800000, 1100], [1201129200000, 1200], [1201215600000, 1300], [1201302000000, 1700], [1201388400000, 1450], [1201474800000, 1500], [1201561200000, 1510], [1201647600000, 1510], [1201734000000, 1510], [1201820400000, 1700], [1201906800000, 1800], [1201993200000, 1900], [1202079600000, 2000], [1202166000000, 2100], [1202252400000, 2200], [1202338800000, 2300], [1202425200000, 2400], [1202511600000, 2550], [1202598000000, 2600], [1202684400000, 2500], [1202770800000, 2700], [1202857200000, 2750], [1202943600000, 2800], [1203030000000, 3245], [1203116400000, 3345], [1203202800000, 3000], [1203289200000, 3200], [1203375600000, 3300], [1203462000000, 3400], [1203548400000, 3600], [1203634800000, 3700], [1203721200000, 3800], [1203807600000, 4000], [1203894000000, 4500]];
										
											for (var i = 0; i < d.length; ++i) {
												d[i][0] += 60 * 60 * 1000;
											}
										
											var options = {

												xaxis : {
													mode : "time",
													tickLength : 5
												},

												series : {
													lines : {
														show : true,
														lineWidth : 1,
														fill : true,
														fillColor : {
															colors : [{
																opacity : 0.1
															}, {
																opacity : 0.15
															}]
														}
													},
												   //points: { show: true },
													shadowSize : 0
												},

												selection : {
													mode : "x"
												},

												grid : {
													hoverable : true,
													clickable : true,
													tickColor : $color_border_color,
													borderWidth : 0,
													borderColor : $color_border_color,
												},

												tooltip : true,

												tooltipOpts : {
													content : "Sales: %x <span class='block'>$%y</span>",
													dateFormat : "%y-%0m-%0d",
													defaultTheme : false
												},

												colors : [$color_second],
										
											};
										
											var plot = jQuery.plot(jQuery("#flot-sales"), [d], options);
										}

									});
								});
							});
						});
					});
				});
			});
			</script>
    @section('scripts')
        
    @show
	</body>
</html>
