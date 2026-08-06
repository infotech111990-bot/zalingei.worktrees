@extends('site.layouts.associations')
@section('sectionTitle')
    <h2 class="mb-none">@lang('site.associationNews',['ar'=>$association->title,'en'=>$association->titleEn])</h2>
@stop    
@section('content')
    <div class="portfolio-info">
        <div class="row">
            <div class="col-md-12 center">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-eye"></i>{{$newsDisplay->views}}</a>
                    </li>
                    <li>
                        <i class="fa fa-calendar"></i> <span dir="ltr">{{date('d M Y', strtotime($newsDisplay->newsDate))}} </span>
                    </li>
                    <li>
                        <i class="fa fa-tags"></i> <a href="#">أخبار عامة</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <h3 class="mt-sm" style="line-height:1.5em;">{{$newsDisplay->title}}</h3>
        <div style="text-align:center">
            <span class="img-thumbnail">
                <img alt="{{$newsDisplay->getPicture()}}" class="img-responsive" src="{{$newsDisplay->getPicture()}}">
            </span>
        </div>
    <p class="mt-xlg">{!! $newsDisplay->txt !!}</p>
@stop