
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>@lang('site.siteName')</title>
		<meta name="description" content="" />
		<meta name="Author" content="Dorin Grigoras [www.stepofweb.com]" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css2?family=Tajawal:wght@200;400&display=swap" rel="stylesheet">

		<!-- CORE CSS -->
		<link href="{{ asset('public/assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/plugins/bootstrap/RTL/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="{{ asset('public/assets/admin/css/essentials-RTL.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/css/layout.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/admin/css/layout-RTL.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/admin/css/blue.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
        
	</head>
	<!--
		.boxed = boxed version
	-->
	<body>


        @section('content')
            
        @show
	
		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '{{ request()->root() }}/public/assets/admin/plugins/';</script>
		<script type="text/javascript" src="{{ asset('public/assets/admin/plugins/jquery/jquery-2.2.3.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('public/assets/admin/js/app.js') }}"></script>
	</body>
</html>