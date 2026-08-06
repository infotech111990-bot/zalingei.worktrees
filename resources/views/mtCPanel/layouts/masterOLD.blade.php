<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{Lang::get('mtCPanel.siteTitle')}}</title>
    <!-- Bootstrap Core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="{{Request::root()}}/public/assets/mtCPanel/css/sb-admin-2ar.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link href="{{Request::root()}}/public/assets/mtCPanel/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- Include one of jTable styles. -->
    <link href="{{Request::root()}}/public/assets/mtCPanel/jtable/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href="{{Request::root()}}/public/assets/mtCPanel/jtable/themes/metro/lightgray/jtable.css" rel="stylesheet" type="text/css" />
    <!-- <link href="{{Request::root()}}/assets/jtable/themes/jqueryui/jtable_jqueryui.min.css" rel="stylesheet" type="text/css" /> -->

    <link href="{{Request::root()}}/public/assets/mtCPanel/uploadify/uploadify.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .jtable-child-table-container{
        margin-left: 25px;
    }
    .menuPanelBody { padding:0px; }
    .menuPanelBody table tr td { padding-right: 15px }
    .menuPanelBody .table {margin-bottom: 0px; }    
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
                <a class="navbar-brand" href="{{Request::root()}}/mtCPanel"><img src="{{Request::root()}}/public/assets/mtCPanel/images/logo.png" width="150" alt="" style="margin: -5px;"> </a>
                <a class="navbar-brand"><i class="fa fa-user"></i> {{auth()->guard('admin')->user()->name}}</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<li>
					<a href="#">
                       <strong>{{Lang::get('messages.userName')}} :</strong> {{auth()->guard('admin')->user()->name}}
                    </a>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-language fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="{{Request::root()}}/language/ar">
                                <div>
                                    <strong>عربي</strong>
                                    <span class="pull-right text-muted">
                                        <em>اللغة العربية</em>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{Request::root()}}/language/en">
                                <div>
                                    <strong>English</strong>
                                    <span class="pull-right text-muted">
                                        <em>English Language</em>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{Request::root()}}/language/fr">
                                <div>
                                    <strong>French</strong>
                                    <span class="pull-right text-muted">
                                        <em>Langue française</em>
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{Request::root()}}/logOut"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="row margin-top-15">
                        <center><img src="{{Request::root()}}/includes/adminPics/{{auth()->guard('admin')->user()->adminPic}}" class="img-circle" width="75px;" style="border: 2px solid #999;" /></center>
                </div>
                <div class="panel-group" id="accordion" style="margin:15px;">
                    @foreach(Config::get("mtcpanel.dashboardMenuArr") as $DBM)
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#{{$DBM['sectionID']}}">
                                        <span class="fa fa-fw fa-spin fa-{{$DBM['sectionIcon']}}"></span> {{$DBM['sectionTitle']}}</a>
                                </h4>
                            </div>
                            <div id="{{$DBM['sectionID']}}" class="panel-collapse collapse">
                                <div class="panel-body menuPanelBody">
                                    <table class="table">
                                        @foreach($DBM['menuData'] as $DBMItem)
                                            @if(auth()->guard('admin')->user()->hasMainPriv($DBMItem['menuID']))
                                                <tr>
                                                    <td>
                                                        <a href="{{Request::root()}}/mtCPanel/{{$DBMItem['menuID']}}"><i class="fa fa-fw fa-{{$DBMItem['menuIcon']}}"></i> {{Lang::get('admin.'.$DBMItem['menuID'])}}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="padding-bottom:50px; background:url('{{Request::root()}}/public/assets/mtCPanel/images/mainAreaBG.jpg') no-repeat left top;">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- script src="//code.jquery.com/jquery-2.1.0.min.js"></script -->
    <script src="{{Request::root()}}/public/assets/mtCPanel/jtable/jquery-1.9.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <script src="{{Request::root()}}/public/assets/mtCPanel/jtable/jquery-ui-1.10.0.min.js"></script>

    <!-- Include jTable script file. -->
    <script src="{{Request::root()}}/public/assets/mtCPanel/jtable/jquery.jtable.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/jtable/localization/jquery.jtable.ar.js"></script>
    <script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/adapters/jquery.js"></script>
    <script type="text/javascript" src="{{Request::root()}}/public/assets/mtCPanel/ckeditor/bootstrap-ckeditor-fix.js"></script>

    <script src="{{Request::root()}}/public/assets/mtCPanel/uploadify/jquery.uploadify.min.js"></script>

</body>

</html>
@yield('scripts')