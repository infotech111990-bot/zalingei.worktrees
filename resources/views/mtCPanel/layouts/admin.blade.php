<!DOCTYPE html>

<html lang="en">

<head>

  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>منظمة الرعاية الطبية - السجل الطوعي الطبي - لوحة تحكم الإدارة</title>



    <!-- Bootstrap Core CSS -->

    <!-- Global CSS -->

    @if(Session::get('lang') == 'en') 

		<link rel="stylesheet" href="{{ asset('assets/userAccount/css/bootstrap.css') }}">   

		<link href="{{ asset('assets/userAccount/css/sb-admin-ar.css') }}" rel="stylesheet">

	@else

		<link rel="stylesheet" href="{{ asset('assets/userAccount/css/bootstrap-ar.css') }}">   

		<link href="{{ asset('assets/userAccount/css/sb-admin-2ar.css') }}" rel="stylesheet">

	@endif

    <link rel="stylesheet" href="{{ asset('assets/userAccount/plugins/font-awesome/css/font-awesome.css') }}">





	<!-- Optional theme -->

	<link rel="stylesheet" href="{{ asset('assets/userAccount/css/bootstrap-theme.min.css') }}">

    <!-- Custom CSS -->

@yield('css')


    <link href="{{ asset('assets/userAccount/uploadify/uploadify.css') }}" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

<style>

    .jtable-child-table-container{

        margin-left: 25px;

    }

    .menuPanelBody { padding:0px; }

    .menuPanelBody table tr td { padding-right: 15px }

    .menuPanelBody .table {margin-bottom: 0px; }    



/* Loading Circle */

.ball {

	background-color: rgba(0,0,0,0);

	border:5px solid rgba(0,183,229,0.9);

	opacity:.9;

	border-top:5px solid rgba(0,0,0,0);

	border-left:5px solid rgba(0,0,0,0);

	border-radius:50px;

	box-shadow: 0 0 35px #2187e7;

	width:50px;

	height:50px;

	margin:0 auto;

	-moz-animation:spin .5s infinite linear;

	-webkit-animation:spin .5s infinite linear;

}



.ball1 {

	background-color: rgba(0,0,0,0);

	border:5px solid rgba(0,183,229,0.9);

	opacity:.9;

	border-top:5px solid rgba(0,0,0,0);

	border-left:5px solid rgba(0,0,0,0);

	border-radius:50px;

	box-shadow: 0 0 15px #2187e7; 

	width:30px;

	height:30px;

	margin:0 auto;

	position:relative;

	top:-50px;

	-moz-animation:spinoff .5s infinite linear;

	-webkit-animation:spinoff .5s infinite linear;

}



@-moz-keyframes spin {

	0% { -moz-transform:rotate(0deg); }

	100% { -moz-transform:rotate(360deg); }

}

@-moz-keyframes spinoff {

	0% { -moz-transform:rotate(0deg); }

	100% { -moz-transform:rotate(-360deg); }

}

@-webkit-keyframes spin {

	0% { -webkit-transform:rotate(0deg); }

	100% { -webkit-transform:rotate(360deg); }

}

@-webkit-keyframes spinoff {

	0% { -webkit-transform:rotate(0deg); }

	100% { -webkit-transform:rotate(-360deg); }

}



/* Second Loadin Circle */



.circle {

	background-color: rgba(0,0,0,0);

	border:5px solid rgba(0,183,229,0.9);

	opacity:.9;

	border-right:5px solid rgba(0,0,0,0);

	border-left:5px solid rgba(0,0,0,0);

	border-radius:50px;

	box-shadow: 0 0 35px #2187e7;

	width:50px;

	height:50px;

	margin:0 auto;

	-moz-animation:spinPulse 1s infinite ease-in-out;

	-webkit-animation:spinPulse 1s infinite linear;

}

.circle1 {

	background-color: rgba(0,0,0,0);

	border:5px solid rgba(0,183,229,0.9);

	opacity:.9;

	border-left:5px solid rgba(0,0,0,0);

	border-right:5px solid rgba(0,0,0,0);

	border-radius:50px;

	box-shadow: 0 0 15px #2187e7; 

	width:30px;

	height:30px;

	margin:0 auto;

	position:relative;

	top:-40px;

	-moz-animation:spinoffPulse 1s infinite linear;

	-webkit-animation:spinoffPulse 1s infinite linear;

}



@-moz-keyframes spinPulse {

	0% { -moz-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7;}

	50% { -moz-transform:rotate(145deg); opacity:1; }

	100% { -moz-transform:rotate(-320deg); opacity:0; }

}

@-moz-keyframes spinoffPulse {

	0% { -moz-transform:rotate(0deg); }

	100% { -moz-transform:rotate(360deg);  }

}

@-webkit-keyframes spinPulse {

	0% { -webkit-transform:rotate(160deg); opacity:0; box-shadow:0 0 1px #2187e7; }

	50% { -webkit-transform:rotate(145deg); opacity:1;}

	100% { -webkit-transform:rotate(-320deg); opacity:0; }

}

@-webkit-keyframes spinoffPulse {

	0% { -webkit-transform:rotate(0deg); }

	100% { -webkit-transform:rotate(360deg); }

}   

    

.nav-tabs { border-bottom: 2px solid #DDD; }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }

    .nav-tabs > li > a { border: none; color: #666; }

        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }

        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }

    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }

.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }

.tab-pane { padding: 15px 0; }

.tab-content{padding:20px}



.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }

    

</style>



</head>



<body>



    <div id="wrapper">



        <!-- Navigation -->

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="{{ url('/') }}/userAccount"><img src="{{ asset('assets/userAccount/images/logo.jpg') }}" width="150" alt="" style="margin: -5px;"> </a>

                <a class="navbar-brand"><i class="fa fa-user"></i> {{ auth()->guard('admin')->user()->name }}</a>

            </div>

            <!-- /.navbar-header -->



            <ul class="nav navbar-top-links navbar-right">

				<li>

					<a href="#">

                       <strong> {{ auth()->guard('admin')->user()->email }} </strong>

                    </a>

				</li>

				{{--  <li class="dropdown">

					<a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-language fa-fw"></i>  <i class="fa fa-caret-down"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-messages">

                        <li>

                            <a href="{{ url('/') }}/language/ar">

                                <div>

                                    <strong>عربي</strong>

                                    <span class="pull-right text-muted">

                                        <em>اللغة العربية</em>

                                    </span>

                                </div>

                            </a>

                        </li>

                        <li class="divider"></li>

                    </ul> 

                    <!-- /.dropdown-messages -->

                </li>  --}}

                <!-- /.dropdown -->

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li>
                            <form method="POST" action="{{ route('mtCPanel.logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link"><i class="fa fa-sign-out fa-fw"></i> تسجيل الخروج</button>
                            </form>
                        </li>

                    </ul>

                    <!-- /.dropdown-user -->

                </li>

                <!-- /.dropdown -->

            </ul>

            <!-- /.navbar-top-links -->



            

            <div class="navbar-default sidebar" role="navigation">

                <div class="row margin-top-15" style="text-align:center">

                    <i class="fa fa-user fa-fw fa-5x"></i>

                </div>

                

                <div class="panel-group" id="accordion" style="margin:15px;">

                        <div class="panel panel-primary">

                            <div class="panel-heading">

                                <h4 class="panel-title">

                                    <a href="{{ url('/') }}/admin">

                                        <span class="fa fa-fw fa-home"></span> {{Lang::get('site.home')}}</a>

                                </h4>

                            </div>

                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#activities">
                                        <span class="fa fa-fw fa-comments"></span> الأنشطة والفعاليات</a>
                                </h4>
                            </div>
                            <div id="activities" class="panel-collapse collapse">
                                <div class="panel-body menuPanelBody">
                                    <table class="table">
                                        <tr><td><a href="{{ url('/') }}/admin/activities"><i class="fa fa-fw fa-comments"></i> قائمة الأنشطة والفعاليات </a></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#vols">
                                        <span class="fa fa-fw fa-comments"></span> المتطوعين </a>
                                </h4>
                            </div>
                            <div id="vols" class="panel-collapse collapse">
                                <div class="panel-body menuPanelBody">
                                    <table class="table">
                                        <tr><td><a href="{{route('admin.vols')}}"><i class="fa fa-fw fa-comments"></i> قائمة المتطوعين </a></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <div class="panel panel-danger">

                        <div class="panel-heading">

                            <h4 class="panel-title">

                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                            </h4>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /.navbar-static-side -->

        </nav>



        <div id="page-wrapper" style="padding-bottom:50px; background:url('{{ asset('assets/userAccount/images/mainAreaBG.jpg'') }}) #FFF no-repeat left top;">
            <div class="row">
	            <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->



    <!-- script src="//code.jquery.com/jquery-2.1.0.min.js"></script -->

    <script src="{{ asset('assets/userAccount/jtable/jquery-1.9.1.min.js') }}"></script>

    <script src="{{ asset('assets/userAccount/js/bootstrap.min.js') }}"></script>

    

    <script src="{{ asset('assets/userAccount/jtable/jquery-ui-1.10.0.min.js') }}"></script>

    <!-- Include jTable script file. -->

    <script src="{{ asset('assets/userAccount/jtable/jquery.jtable.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('assets/userAccount/jtable/localization/jquery.jtable.ar.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/userAccount/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/userAccount/ckeditor/adapters/jquery.js') }}"></script>
    
    



    <script src="{{ asset('assets/userAccount/uploadify/jquery.uploadify.min.js') }}"></script>

    <script src="{{ asset('assets/photoGallery/js/photo-gallery.js') }}" type="text/javascript" charset="utf-8"></script>

    

    @yield('scripts')

</body>



</html>
