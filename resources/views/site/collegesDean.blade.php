@extends('site.layouts.college')

@section('content')
    @php($details = $college->details)
    <section class="college-hero"><div class="container">
        <div class="eyebrow">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</div>
        <h1>@lang('site.getContent',['ar'=>$college->type->deanshipWordTitle,'en'=>$college->type->deanshipWordTitleEn])</h1>
    </div></section>
    <main class="college-content"><div class="container"><div class="row"><div class="col-md-9">
        @if($details && $details->dean_name)
            <article class="dean-card">
                <img class="dean-photo" src="{{ $details->dean_picture ? asset('includes/colleges/deans/'.$details->dean_picture) : asset('includes/staff/no-picture.gif') }}" alt="{{ Lang::get('site.getContent',['ar'=>$details->dean_name,'en'=>$details->dean_name_en]) }}">
                <div>
                    <h2>{{ Lang::get('site.getContent',['ar'=>$details->dean_name,'en'=>$details->dean_name_en]) }}</h2>
                    <h3>{{ Lang::get('site.getContent',['ar'=>$details->dean_title,'en'=>$details->dean_title_en]) }}</h3>
                    @if($details->dean_email)<a href="mailto:{{ $details->dean_email }}"><i class="fa fa-envelope"></i> {{ $details->dean_email }}</a>@endif
                    @if($details->dean_bio)<div class="dean-message">{!! Lang::get('site.getContent',['ar'=>$details->dean_bio,'en'=>$details->dean_bio_en]) !!}</div>@endif
                </div>
            </article>
        @endif
        @if($details && ($details->deanWord || $details->deanWordEn))
            <section class="academic-card college-section"><h2>@lang('site.getContent',['ar'=>'كلمة العميد','en'=>'Dean’s message'])</h2>
                <div class="lead">{!! Lang::get('site.getContent',['ar'=>$details->deanWord,'en'=>$details->deanWordEn]) !!}</div>
            </section>
        @endif
        @if(!$details || (!$details->dean_name && !$details->deanWord && !$details->deanWordEn))
            <section class="academic-card college-section"><p class="lead">@lang('site.getContent',['ar'=>'سيتم نشر بيانات العميد قريباً.','en'=>'The dean’s profile will be published soon.'])</p></section>
        @endif
    </div><aside class="col-md-3">@include('site.collegeSidebar')</aside></div></div></main>
@stop
