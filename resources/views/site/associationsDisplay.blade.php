@extends('site.layouts.associations')
@section('sectionTitle')
    <h2 class="mb-none">@lang('site.getContent', ['ar'=>$association->title, 'en'=>$association->titleEn ])</h2>
@stop    
@section('content')
    <div class="portfolio-info">
        <div class="row">
            <div class="col-md-12 center">
                <ul>
                    <li>
                        <a style="cursor:pointer" id="likeThis" assocID="{{$association->id}}" data-tooltip="" data-original-title="@lang('site.like')"><i class="fa fa-heart"></i><span id="likeArea">{{number_format($association->likeCount)}}</span></a>
                    </li>
                    <li>
                        <a data-tooltip="" data-original-title="@lang('site.watching')"><i class="fa fa-eye"></i>{{number_format($association->views)}}</a>
                    </li>
                    @if($association->establishment != null)
                    <li>
                        <a data-tooltip="" data-original-title="@lang('site.establishmentDate')"><i class="fa fa-calendar"></i> @lang('site.getContent', ['ar'=>'تأسس في العام: '.$association->establishment, 'en'=>'Established in: '.$association->establishment ])</a>
                    </li>
                    @endif
                    @if($association->url != null)
                    <li>
                        <a href="{{$association->url}}" target="_blank" data-tooltip="" data-original-title="@lang('site.website')"><i class="fa fa-internet-explorer"></i> {{$association->url}}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <img alt="" class="img-responsive thumbnail" src="{{$association->getPicture()}}">
    <h4 class="mt-lg">@lang('site.aboutAssociation')</h4>
    <p class="mt-xlg" style="font-color:#000;">@lang('site.getContent', ['ar'=>$association->desc,'en'=>$association->descEn])</p>
    @if($association->url != null)
        <a href="{{$association->url}}" target="_blank" class="btn btn-primary btn-icon"><i class="fa fa-external-link"></i>@lang('site.VisitOfficialWebSite')</a> <span class="arrow hlb appear-animation animated rotateInUpLeft appear-animation-visible" data-appear-animation="rotateInUpLeft" data-appear-animation-delay="800"></span>
    @endif
@stop