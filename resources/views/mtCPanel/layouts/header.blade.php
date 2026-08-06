<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  



<!-- Mirrored from themes.3rdwavemedia.com/velocity/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Dec 2014 06:43:41 GMT -->

<head>

    <title>{{Lang::get('site.siteTitle')}}</title>

    <!-- Meta -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="">    

    <link rel="shortcut icon" href="favicon.ico">  

    <!-- Global CSS -->

    @if(Session::get('lang') == 'en') 

		<link rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/css/bootstrap.css">   

		<link id="theme-style" rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/css/styles.css">

	@else

		<link rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/css/bootstrap-ar.css">   

		<link id="theme-style" rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/css/styles.ar.css">

	@endif

    <!-- Plugins CSS -->    

    <link rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/plugins/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" href="{{Request::root()}}/public/assets/mtCPanel/plugins/flexslider/flexslider.css">

    <!-- Theme CSS -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

</head> 



<body class="home-page">   

    <!-- ******HEADER****** --> 

    <header id="header" class="header">  

        <div class="container">       

            <h1 class="logo1" style="width:250px;">

                <a href="{{Request::root()}}/mtCPanel">

					<img src="{{Request::root()}}/public/assets/mtCPanel/images/logo.png">

				</a>

            </h1><!--//logo-->

            <nav class="main-nav navbar-right" role="navigation">

                <div class="navbar-header">

                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">

                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button><!--//nav-toggle-->

                </div><!--//navbar-header-->

            </nav><!--//main-nav-->                     

        </div><!--//container-->

    </header><!--//header-->