@extends('site.layouts.master')
<?php $page = App\Page::find(10); ?>
@section('css')
<style>
.team{
    /* padding:0; */
    /* border:1px solid; */
}
h6.description{
	font-weight: bold;
	letter-spacing: 2px;
	color: #999;
	border-bottom: 1px solid rgba(0, 0, 0,0.1);
	padding-bottom: 5px;
}
.profile{
	margin-top: 25px;
}
.profile h1{
	font-weight: normal;
	font-size: 20px;
	margin:10px 0 0 0;
}
.profile h2{
	font-size: 14px;
	font-weight: lighter;
	margin-top: 5px;
}
.profile .img-box{
	opacity: 1;
	display: block;
	position: relative;
}
.profile .img-box:after{
	content:"";
	opacity: 0;
	background-color: rgba(0, 0, 0, 0.75);
	position: absolute;
	right: 0;
	left: 0;
	top: 0;
	bottom: 0;
}
.img-box ul{
	position: absolute;
	z-index: 2;
	bottom: 50px;
	text-align: center;
	width: 100%;
	padding-left: 0px;
	height: 0px;
	margin:0px;
	opacity: 0;
}
.profile .img-box:after, .img-box ul, .img-box ul li{
	-webkit-transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    transition: all 0.5s ease-in-out 0s;
}
.img-box ul i{
	font-size: 20px;
	letter-spacing: 10px;
}
.img-box ul li{
	width: 30px;
    height: 30px;
    text-align: center;
    border: 1px solid #88C425;
    margin: 2px;
    padding: 5px;
	display: inline-block;
}
.img-box a{
	color:#fff;
}
.img-box:hover:after{
	opacity: 1;
}
.img-box:hover ul{
	opacity: 1;
}
.img-box ul a{
	-webkit-transition: all 0.3s ease-in-out 0s;
	-moz-transition: all 0.3s ease-in-out 0s;
	transition: all 0.3s ease-in-out 0s;
}
.img-box a:hover li{
	border-color: #fff;
	color: #88C425;
}
</style>
@endsection
@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url({{request()->root()}}/public/autostars/images/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
            <div class="container">
                <h1 class="page-title">@lang('site.council')</h1>
               </div>
        </div>
        <!-- Utiity Bar -->
        <div class="utility-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-8">
                            <ol class="breadcrumb">
                                <li><a href="{{request()->root()}}/">@lang('site.home')</a></li>
                                <li class="active">@lang('site.council')</li>
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
                    <div class="col-md-9 single-post">
                    <header class="single-post-header clearfix">
                            <h2 class="post-title">@lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])</h2>
                    </header>
                    <section class="team">
                            <div class="container1">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="col-lg-12">
                                    <div class="row pt-md">
                                        @foreach($councils as $member)
                                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 profile">
                                        <div class="img-box img-thumbnail">
                                          <img src="http://nabeel.co.in/files/bootsnipp/team/1.jpg" class="img-responsive">
                                          <ul class="text-center">
                                            {{--  <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                            <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                            <a href="#"><li><i class="fa fa-linkedin"></i></li></a>  --}}
                                          </ul>
                                        </div>
                                        <h1>{{$member->title}}</h1>
                                        <h2>Co-founder/ Operations</h2>
                                      </div>
                                      @endforeach
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                    </div>
                    <!-- Start Sidebar -->
                    <div class="col-md-3 sidebar">
                        @include('site.subMenu')
                        @include('site.newsMenu')
                    </div>
                </div>
            </div>
        </div>
    <!-- End Body Content -->
@stop