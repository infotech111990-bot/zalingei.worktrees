@extends('site.layouts.associations')
@section('sectionTitle')
    <h2 class="mb-none">@lang('site.getContent',['ar'=>$details->title,'en'=>$details->titleEn])</h2>
@stop    
@section('content')
    <div class="row">

            {{--  <div class="portfolio-info">
                <div class="row">
                    <div class="col-md-12 center">
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-eye"></i>{{$news->views}}</a>
                            </li>
                            <li>
                                <i class="fa fa-calendar"></i> <span dir="ltr">{{date('d M Y', strtotime($news->newsDate))}} </span>
                            </li>
                            <li>
                                <i class="fa fa-tags"></i> <a href="#">أخبار عامة</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>  --}}

                {{--  <div style="text-align:center">
                    <span class="img-thumbnail">
                        <img alt="{{$news->getPicture()}}" class="img-responsive" src="{{$news->getPicture()}}">
                    </span>
                </div>  --}}
            <p class="mt-xlg" style="text-align:justify">
                @if(app()->getLocale() == 'ar')
                    {!! $details->txt !!}
                @else
                    {!! $details->txtEn !!}
                @endif

                
            </p>


        
    </div>

@stop