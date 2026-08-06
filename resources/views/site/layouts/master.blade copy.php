<!DOCTYPE HTML>
<html class="no-js">
<head>
<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>@lang('site.siteName')</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<!-- CSS
  ================================================== -->
<link href="{{request()->root()}}/public/autostars/css/bootstrap.css" rel="stylesheet" type="text/css">
{{-- <link href="{{request()->root()}}/public/autostars/css/bootstrap-rtl.css" rel="stylesheet" type="text/css"> --}}
<link href="{{request()->root()}}/public/autostars/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="{{request()->root()}}/public/autostars/css/style.css" rel="stylesheet" type="text/css">
{{-- <link href="{{request()->root()}}/public/autostars/css/rtl.css" rel="stylesheet" type="text/css"> --}}
<link href="{{request()->root()}}/public/autostars/vendor/prettyphoto/css/prettyPhoto.css" rel="stylesheet" type="text/css">
<link href="{{request()->root()}}/public/autostars/vendor/owl-carousel/css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="{{request()->root()}}/public/autostars/vendor/owl-carousel/css/owl.theme.css" rel="stylesheet" type="text/css">
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="{{request()->root()}}/public/autostars/css/ie.css" media="screen" /><![endif]-->

@if(Config::get('app.locale') == 'ar') 
    <link href="{{request()->root()}}/public/autostars/css/custom.css" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
@endif

<!-- Color Style -->
<link href="{{request()->root()}}/public/autostars/colors/color13.css" rel="stylesheet" type="text/css">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
@section('css')
@show
<style>
.btn-outline {
    background-color: transparent;
    color: inherit;
    transition: all .5s;
}

.btn-primary.btn-outline {
    color: #428bca;
}

.btn-success.btn-outline {
    color: #5cb85c;
}

.btn-info.btn-outline {
    color: #5bc0de;
}

.btn-warning.btn-outline {
    color: #f0ad4e;
}

.btn-danger.btn-outline {
    color: #d9534f;
}

.btn-primary.btn-outline:hover,
.btn-success.btn-outline:hover,
.btn-info.btn-outline:hover,
.btn-warning.btn-outline:hover,
.btn-danger.btn-outline:hover {
    color: #fff;
}    
</style>
<!-- SCRIPTS
  ================================================== -->
<script src="{{request()->root()}}/public/autostars/js/modernizr.js"></script><!-- Modernizr -->
</head>
<body class="home">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<div class="body">
	<!-- Start Site Header -->
	<div class="site-header-wrapper">
        <header class="site-header">
            <div class="container sp-cont">
                <div class="site-logo">
                    <h1><a href="index.html"><img src="{{request()->root()}}/public/autostars/images/logo.png" alt="Logo"></a></h1>
                    <span class="site-tagline">
                        <span style="font-family: Changa; font-size:25px; color:#000; line-height:1.5em;">@lang('site.itsco')</span><br>
                        <span style="font-family: Changa; font-size:20px; color:#000;">@lang('site.oneOfFIBSCompanies')</span></span>
                </div>
                <div class="header-right">
                </div>
            </div>
        </header>
        <!-- End Site Header -->
        <div class="navbar">
            <div class="container sp-cont">
                <div class="search-function">
                    <a href="{{ request()->root() }}/lang/@lang('site.getContent', ['ar'=>'en','en'=>'ar'])" target="_self" class="search-trigger"> @lang('site.getContent', ['ar'=>'English','en'=>'عربي']) </a>
                    <span><i class="fa fa-envelope"></i> @lang('site.contactUs'): <strong><span dir="ltr"> <a href="mailto://info@itsco.sd" target="_blank">info@itsco.sd</a> </span></strong> 
                    </span>
                </div>
                <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
                <!-- Main Navigation -->
                @include('site.menu')
            </div>
        </div>
    </div>
    @section('content')
    @show  
    <!-- Start site footer -->
    <footer class="site-footer">
       	<div class="site-footer-top">
       		<div class="container">
                <div class="row">
                	<div class="col-md-3 col-sm-6 footer_widget widget widget_custom_menu widget_links">
                    	<h4 class="widgettitle">@lang('site.aboutUs')</h4>
                        <ul>
                        <?php $aboutSubLinks = App\Page::where('parentID',2)->get(); ?>
                            @foreach($aboutSubLinks as $asl)
                                <li><a href="{{$asl->getLink()}}">@lang('site.getContent',['ar'=>$asl->title, 'en'=>$asl->titleEn])</a></li>
                            @endforeach
                        </ul>
                    </div>
                	<div class="col-md-4 col-sm-6 footer_widget widget widget_custom_menu widget_links">
                        <h4 class="widgettitle">@lang('site.lastNews')</h4>
                        @if(Config::get('app.locale') == 'ar')
                            <?php $lastFooterNews = App\News::where('lang',1)->orderBy('created_at','DESC')->limit(5)->get(); ?>
                        @else
                            <?php $lastFooterNews = App\News::where('lang',2)->orderBy('created_at','DESC')->limit(5)->get(); ?>
                        @endif
                        <ul>
                            @foreach($lastFooterNews as $lfn)
                                <li><a href="{{request()->root()}}/news/{{$lfn->id}}">{{Str::words(strip_tags($lfn->title),6)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                	<div class="col-md-5 col-sm-6 footer_widget widget text_widget">
                    	<h4 class="widgettitle">@lang('site.contactUs')</h4>
                        <p align="justify">@lang('site.siteName')</p>
                        <p><strong>@lang('site.address'):</strong> @lang('site.addressLine1')</p>
                        <!-- <p><strong>@lang('site.phone'):</strong> <span dir="ltr">@lang('site.addressPhone')</span></p> -->
                        <p><strong>@lang('site.email'):</strong> <a href="mailto://@lang('site.addressEmail')"> @lang('site.addressEmail') </a></p>
                    </div>
                </div>
            </div>
     	</div>
        <div class="site-footer-bottom">
        	<div class="container">
                <div class="row">
                	<div class="col-md-6 col-sm-6 copyrights-left">
                    	<p>&copy; 2018 @lang('site.siteName'). @lang('site.rightsReserved')</p>
                    </div>
                    <div class="col-md-6 col-sm-6 copyrights-right">
                        <ul class="social-icons social-icons-colored pull-right">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="youtube"><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li class="flickr"><a href="#"><i class="fa fa-flickr"></i></a></li>
                            <li class="vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                            <li class="digg"><a href="#"><i class="fa fa-digg"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End site footer -->
  	<a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>  
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Login to your account</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Login">
                </form>
           	</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-facebook btn-social"><i class="fa fa-facebook"></i> Login with Facebook</button>
                <button type="button" class="btn btn-block btn-twitter btn-social"><i class="fa fa-twitter"></i> Login with Twitter</button>
            </div>
        </div>
    </div>
</div>
<script src="{{request()->root()}}/public/autostars/js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
<script src="{{request()->root()}}/public/autostars/vendor/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
<script src="{{request()->root()}}/public/autostars/js/ui-plugins.js"></script> <!-- UI Plugins -->
<script src="{{request()->root()}}/public/autostars/js/helper-plugins.js"></script> <!-- Helper Plugins -->
<script src="{{request()->root()}}/public/autostars/vendor/owl-carousel/js/owl.carousel.min.js"></script> <!-- Owl Carousel -->
<script src="{{request()->root()}}/public/autostars/vendor/password-checker.js"></script> <!-- Password Checker -->
<script src="{{request()->root()}}/public/autostars/js/bootstrap.js"></script> <!-- UI -->
<script src="{{request()->root()}}/public/autostars/js/init.js"></script> <!-- All Scripts -->
<script src="{{request()->root()}}/public/autostars/vendor/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
@section('scripts')
@show

</body>
</html>