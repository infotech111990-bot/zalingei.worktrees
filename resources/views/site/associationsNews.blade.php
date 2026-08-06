@extends('site.layouts.associations')
@section('sectionTitle')
    <h2 class="mb-none">@lang('site.associationNews',['ar'=>$association->title,'en'=>$association->titleEn])</h2>
@stop    
@section('content')
    @if($association->news->count() > 0)
        <ul class="simple-post-list">
            @foreach($association->news as $assocNews)
                <li>
                    <div class="post-image">
                        <div class="img-thumbnail">
                            <a href="{{request()->root()}}/associations/{{$association->id}}/news/{{$assocNews->id}}">
                                <img style="width:50px; heigt:50px;" src="{{$assocNews->getPicture()}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="post-info">
                        <a href="{{request()->root()}}/associations/{{$association->id}}/news/{{$assocNews->id}}">{{$assocNews->title}}</a>
                        <div class="post-meta">
                            <span dir="ltr">{{date('d M Y', strtotime($assocNews->newsDate))}} </span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
@stop