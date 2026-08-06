@extends('site.layouts.master')

@section('content')
<div class="zr-page-hero">
    <div class="container">
        <span class="zr-eyebrow">@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'UNIVERSITY OF ZALINGEI'])</span>
        <h1>@lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])</h1>
    </div>
</div>

<div id="page-content" class="zr-inner-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <article class="zr-content-card">
                    @if($page->getPicture())
                        <img src="{{ $page->getPicture() }}" class="zr-page-image" alt="">
                    @endif
                    <div class="zr-richtext">
                        {!! Lang::get('site.getContent',['ar'=>$page->txt,'en'=>$page->txtEn]) !!}
                    </div>
                </article>
            </div>
            <div class="col-md-3">
                <aside class="zr-sidebar">
                    @include('site.newsMenu')
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
