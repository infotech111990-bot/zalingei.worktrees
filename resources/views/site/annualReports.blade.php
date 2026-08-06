@extends('site.layouts.master')
@section('content')
<section class="my-breadcrumb">
    <div class="container page-banner">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <h1>@lang('site.council')</h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">@lang('site.home')</a></li>
                    <li><a href="">@lang('site.aboutUs')</a></li>
                    <li class="active">@lang('site.council')</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="blog-posts">
    <div class="container">
        <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12">
        <aside>

           <div class="widget">
              <!--Recent Posts heading-->
              <h4>@lang('site.previousCouncil')</h4>
              <!--end Recent Posts--> 
              <!--Instagram section-->
                <div class="tag_cloud" style="padding:0px;">
                    @for($y = date('Y')-1; $y >= 2005; $y--)
                        <div class="col-md-3" style="padding:0;">
                            <a href="/annualReport/{{$y}}" class="form-control">{{$y}}</a>
                        </div>
                    @endfor
                </div>
           </div>
        </aside>
     </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="heading">
                        <span class="heading-letter-style">@lang('site.council')</span>
                        <div class="main-heading-container">
                            <h3>@lang('site.previousCouncil')</h3>
                            <h1>@lang('site.annualReportForYear',['year'=>$year])</h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-5">
                            <img src="{{$report->getImage()}}" class="img-responsive thumbnail" />
                        </div>
                        <div class="col-md-7">
                            <table class="table table-striped table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.councilTitle')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($report->details as $rd)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>@lang('site.getContent', ['ar'=>$rd->title, 'en'=>$rd->titleEn])</td>
                                            <td>
                                                <a href="{{$rd->getPDF()}}" target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-fw fa-download"></i>
                                                    @lang('site.download')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@stop