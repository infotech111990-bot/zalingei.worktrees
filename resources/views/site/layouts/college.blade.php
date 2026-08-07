<!DOCTYPE html>

<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Theme Starz">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Tajawal:400,700' rel='stylesheet' type='text/css'>
        <link href="{{ asset('universo/assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/bootstrap/css/' . Lang::get('site.getContent',['ar'=>'bootstrap.ar.css','en'=>'bootstrap.css'])) }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/bootstrap/css/' . Lang::get('site.getContent',['ar'=>'bootstrap-rtl.min.css','en'=>''])) }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/css/selectize.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/css/' . Lang::get('site.getContent',['ar'=>'owl.carousel.css','en'=>'owl.carousel.css'])) }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/css/vanillabox/vanillabox.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('universo/assets/css/layerslider.css') }}" type="text/css">
        
        <link rel="stylesheet" href="{{ asset('universo/assets/css/' . Lang::get('site.getContent',['ar'=>'style-rtl.css','en'=>'style.css'])) }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/' . Lang::get('site.getContent',['ar'=>'mt-rtl.css','en'=>'mt.css'])) }}" type="text/css">
    
        <title>@lang('site.siteName') - {{ $college->title }}</title>
    
    </head>
    
    <body class="page-sub-page page-microsite">
    <!-- Wrapper -->
    <div class="wrapper">
    <!-- Header -->
    <div class="navigation-wrapper">
        <div class="secondary-navigation-wrapper">
            <div class="container">
                <div class="navigation-contact pull-@lang('site.getContent',['ar'=>'right','en'=>'left'])">@lang('site.language'):
                    <span class="opacity-70"><a href="{{ url('/') }}/lang/@lang('site.getContent', ['ar'=>'en','en'=>'ar'])" target="_self" class="search-trigger"> @lang('site.getContent', ['ar'=>'English','en'=>'عربي']) </a></span>
                </div>
            </div>
        </div><!-- /.secondary-navigation -->
    
        <div class="branding">
            <div class="container">
                <div class="navbar-brand nav" id="brand">
                    <a href="{{ url('/') }}"><img src="{{ asset('universo/assets/img/logo.png') }}" alt="brand"></a>
                </div>
                
                <div class="search pull-right">
                    <h2 style="color:black; margin-right:30px;">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</h2>
                </div>
            </div>
        </div>
    
        @include('site.collegeMenu')
    
    <div id="page-content">
        @section('content')
            
        @show
    </div>
    
    <!-- Footer -->
    <footer id="page-footer">
    
        <section id="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <aside class="logo">
                            <img src="{{ asset('universo/assets/img/logo-white.png') }}" class="vertical-center img-responsive">
                        </aside>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-4">
                        <aside>
                            <header><h4>@lang('site.contactUs')</h4></header>
                            <address>
                                <strong>@lang('site.siteName')</strong> <br />
                                <strong>@lang('site.getContent',['ar'=>$college->title, 'en'=>$college->titleEn])</strong>
                                @if(isset($college->phone))
                                    <br>
                                    <abbr title="@lang('site.phone')">@lang('site.phone'):</abbr> <span dir="ltr">{{ $college->phone }}</span>
                                @endif
                                @if(isset($college->email))
                                    <br>
                                    <abbr title="@lang('site.email')">@lang('site.email'):</abbr> <a href="#">{{ $college->email }}</a>
                                @endif
                            </address>
                        </aside>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-4">
                        <aside>
                            <header><h4>@lang('site.getContent',['ar'=>$college->type->title, 'en'=>$college->type->titleEn])</h4></header>
                            <ul class="list-links">
                                @foreach($college->type->colleges()->orderByRaw('rand()')->limit(5)->get() as $otherCollege)
                                    <li><a href="#">@lang('site.getContent',['ar'=>$otherCollege->title, 'en'=>$otherCollege->titleEn])</a></li>
                                @endforeach
                            </ul>
                        </aside>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-4">
                        <aside>
                            <header><h4>@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</h4></header>
                            <p>
                                {!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$college->txt, 'en' => $college->txtEn])),30) !!}
                            </p>
                            <div>
                                <a href="{{ $college->getUrl() }}/about" class="read-more">@lang('site.more')</a>
                            </div>
                        </aside>
                    </div><!-- /.col-md-3 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="background"><img src="assets/img/background-city.png" class="" alt=""></div>
        </section><!-- /#footer-content -->
    
        <section id="footer-bottom">
            <div class="container">
                <div class="footer-inner">
                    <div class="copyright">@lang('site.siteName'), © @lang('site.rightsReserved') {{ date('Y') }}</div><!-- /.copyright -->
                </div><!-- /.footer-inner -->
            </div><!-- /.container -->
        </section><!-- /#footer-bottom -->
    
    </footer>
    <!-- end Footer -->
    
    </div>
    <!-- end Wrapper -->
    
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery-2.1.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/selectize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery.placeholder.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jQuery.equalHeights.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery.vanillabox-0.1.5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery.tablesorter.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/jquery.flexslider-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/retina-1.1.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('universo/assets/js/fullcalendar.min.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('universo/assets/js/custom.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = window.location;
            $('ul .list-group-item a[href="'+ url +'"]').parent().addClass('active');
            $('ul .list-group-item a').filter(function() {
                 return this.href == url;
            }).parent().addClass('active');
            // console.log( $('ul .list-group-item a').filter(function() {
            //      return this.href == url;
            // }).parent());
        });
    </script> 
</body>
</html>