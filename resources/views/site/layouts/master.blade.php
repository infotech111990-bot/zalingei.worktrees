<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') == 'ar' ? 'ar' : 'en' }}" dir="{{ Config::get('app.locale') == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="University of Zalingei">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('og') @show

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('universo/assets/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('universo/assets/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('universo/assets/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('universo/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('universo/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mt.css') }}">
    <link rel="stylesheet" href="{{ asset('universo/assets/css/zalingei-redesign.css') }}">

    <style>
        /* Topbar text color and logo sizing (can be overridden in CSS files) */
        .zr-topbar .zr-topbar-links a {
            color: #ffffff !important;
            margin-right: 12px;
            display: inline-block;
        }
        .zr-topbar .zr-topbar-links a i {
            color: #ffffff !important;
            margin-right: 6px;
        }
        .zr-topbar .zr-topbar-brand img {
            height: 30px;
            vertical-align: middle;
            margin-right: 8px;
        }
        .zr-topbar .zr-topbar-links a.active {
            font-weight: 700;
            text-decoration: underline;
        }
    </style>

    <title>@lang('site.siteName')</title>
</head>

<body class="zalingei-site">
<div class="site-wrapper">

    <div class="zr-topbar">
        <div class="container">
            <div class="zr-topbar-inner" style="display:flex;align-items:center;justify-content:space-between;">
                <div class="zr-topbar-left" style="display:flex;align-items:center;">
                    <a href="{{ url('/') }}" class="zr-topbar-brand" aria-label="@lang('site.siteName')">
                        <img src="{{ asset('universo/assets/img/logo-top.png') }}" alt="@lang('site.siteName')">
                    </a>
                    <div class="zr-topbar-links" style="margin-left:10px;">
                        <a href="{{ url('lang/ar') }}" class="{{ Config::get('app.locale')=='ar' ? 'active' : '' }}">العربية</a>
                        <a href="{{ url('lang/en') }}" class="{{ Config::get('app.locale')=='en' ? 'active' : '' }}">English</a>
                        <a href="{{ url('webmail') }}" target="_blank"><i class="fa fa-envelope-o"></i> بريد الموظفين</a>
                        <a href="https://me.classera.com/" target="_blank" rel="noopener"><i class="fa fa-laptop"></i> E-Learning</a>
                        <a href="https://www.facebook.com/zalingei.university" target="_blank" rel="noopener"><i class="fa fa-facebook"></i> Facebook</a>
                        <a href="https://www.youtube.com/channel/UCf0rdG0JaJk_VHnxNlnYogQ" target="_blank" rel="noopener"><i class="fa fa-youtube-play"></i> YouTube</a>
                    </div>
                </div>
                <div class="zr-topbar-right">
                    <!-- right-side reserved -->
                </div>
            </div>
        </div>
    </div>

    @include('site.menu')

    @section('content') @show

    <footer class="zr-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="zr-footer-brand">
                        <img src="{{ asset('universo/assets/img/logo-white.png') }}" alt="@lang('site.siteName')">
                        <p>@lang('site.aboutUsDesc')</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>@lang('site.contactUs')</h4>
                    <ul class="zr-footer-list">
                        <li><i class="fa fa-map-marker"></i> @lang('site.addressLine1')</li>
                        <li><i class="fa fa-phone"></i> <span dir="ltr">@lang('site.addressPhone')</span></li>
                        <li><i class="fa fa-envelope"></i> @lang('site.addressEmail')</li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-6">
                    <h4>@lang('site.importantLinks')</h4>
                    <ul class="zr-footer-list">
                        <li><a href="{{ url('news') }}">@lang('site.news')</a></li>
                        <li><a href="{{ url('events') }}">@lang('site.events')</a></li>
                        <li><a href="{{ url('services') }}">@lang('site.services')</a></li>
                        <li><a href="{{ url('contactUs') }}">@lang('site.contactUs')</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>@lang('site.siteName')</h4>
                    <p class="zr-footer-note">@lang('site.rightsReserved') {{ date('Y') }}</p>
                    <div class="zr-social">
                        <a href="https://www.facebook.com/zalingei.university" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.youtube.com/channel/UCf0rdG0JaJk_VHnxNlnYogQ" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="zr-footer-bottom">
            <div class="container">
                <span>@lang('site.siteName') © {{ date('Y') }}</span>
                <span>University of Zalingei</span>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('universo/assets/js/jquery-2.1.0.min.js') }}"></script>
<script src="{{ asset('universo/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('universo/assets/js/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('universo/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('universo/assets/js/custom.js') }}"></script>
<script>
(function () {
    var nav = document.querySelector('.zr-navbar');
    function updateNav() {
        if (window.scrollY > 20) nav.classList.add('is-scrolled');
        else nav.classList.remove('is-scrolled');
    }
    window.addEventListener('scroll', updateNav);
    updateNav();
})();
</script>
@yield('scripts')
</body>
</html>
