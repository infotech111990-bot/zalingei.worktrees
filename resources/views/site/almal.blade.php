@extends('site.layouts.master')
<?php $page = App\Page::find(85); ?>
@section('content')
<section class="my-breadcrumb">
    <div class="container page-banner">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <h1>@lang('site.council')</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">@lang('site.home')</a></li>
                    <li><a href="">@lang('site.aboutUs')</a></li>
                    <li class="active">@lang('site.almal')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="blog-posts">
    <div class="container">
        <div class="row">
   			<div class="col-md-4 col-sm-12 col-xs-12">
				@include('site.subMenu')
			</div>

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="heading">
                            <span class="heading-letter-style">@lang('site.publiactions')</span>
                            <div class="main-heading-container">
                                <h3>@lang('site.almal')</h3>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 nopadding">
                            <div class="alert alert-warning">
                                <p>هي مجلة دورية متنوعة الأبواب مسجلة بالمجلس الإتحادي للمصنفات الأدبية والفنية برقم الإيداع 2012/346 وتهدف إلى تزويد القطاع الإقتصادي والمالي والبحثي ( العلمي والأكاديمي ) بالقضايا المالية والاقتصادية في شكل موضوعات ومقالات. </p>
                            </div>
                            <?php $i=1; ?>
                            @foreach($issues as $issue)
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="team-grid">
                                        <img class="img-responsive" width="100%" alt="" src="{{$issue->getImage()}}">
                                        <div class="team-content">
                                        <h5><a>@lang('site.getContent', ['ar'=>'العدد '.$issue->issue, 'en'=>'Volume No. '.$issue->issue])</a></h5>
                                        <span></span>
                                        <div class="social2">
                                            <ul class="social-icons">
                                                <a target="_blank" href="{{$issue->getPDF()}}" class="btn btn-warning" style="color:white"><i class="fa fa-file"></i> @lang('site.getContent', ['ar'=>'تحميل', 'en'=> 'download'])</a>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @if($i++%3 == 0)
                                    <div class="clearfix"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>

        </div>
    </div>
</section>
@stop