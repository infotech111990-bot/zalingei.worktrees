<div class="widget">
    <ul class="nav nav-list mb-xlg">
            <li>
                <a href="{{request()->root()}}/associations/{{$association->id}}">
                    @lang('site.aboutAssociation')
                </a>
            </li>
            <li>
                <a href="{{request()->root()}}/associations/{{$association->id}}/news">
                    @lang('site.assocNews')
                </a>
            </li>
        @if($association->details->count() > 0)
            @foreach($association->details as $details)
                <li>
                    <a href="{{request()->root()}}/associations/{{$association->id}}/details/{{$details->id}}">
                        @lang('site.getContent',['ar'=>$details->title,'en'=>$details->titleEn])
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>



<h4 class="mb-md text-uppercase">@lang('site.associationNews',['ar'=>$association->title,'en'=>$association->titleEn]):</h4>
    
<div class="row">

    <ul class="portfolio-list">
        @if($association->news->count() > 0)
            @foreach($association->news->take(2) as $assocNews)
            <li class="col-md-12 col-sm-12 col-xs-12">
                <div class="portfolio-item">
                    <a href="{{request()->root()}}/associations/{{$association->id}}/news/{{$assocNews->id}}">
                        <span class="thumb-info thumb-info-lighten">
                            <span class="thumb-info-wrapper">
                                <img src="{{$association->getLogo()}}" class="img-responsive" alt="">
                                <span class="thumb-info-title">
                                    <span class="thumb-info-inner">{{$assocNews->title}}</span>
                                    <span class="thumb-info-type"><i class="fa fa-fw fa-calendar"></i> {{date('Y-m-d',strtotime($assocNews->created_at))}} </span>
                                </span>
                                <span class="thumb-info-action">
                                    <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
            </li>
            @endforeach
        @else
            <div class="alert alert-warning">
                @lang('site.noNewsFound')
            </div>
        @endif
    </ul>

</div>