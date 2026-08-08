@extends('site.layouts.college')

@section('content')
    <section class="college-hero">
        <div class="container">
            <div class="eyebrow">@lang('site.siteName')</div>
            <h1>@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</h1>
            <p>{{ Str::words(strip_tags(Lang::get('site.getContent', ['ar' => $college->txt, 'en' => $college->txtEn])), 34) }}</p>
        </div>
    </section>

    <main class="college-content"><div class="container"><div class="row">
        <div class="col-md-8">
            <section class="academic-card college-section">
                <h2>@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</h2>
                <div class="lead">{!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$college->txt, 'en'=>$college->txtEn])), 95) !!}</div>
                <a class="btn btn-primary margin-top-20" href="{{ route('college.display', ['slug' => $college->slug, 'section' => 'about']) }}">@lang('site.more')</a>
            </section>
            @if($college->departments->count())
                <section class="college-section academic-card"><h2>@lang('site.departments')</h2><div class="row">
                    @foreach($college->departments as $dept)
                        <div class="col-sm-6"><a class="academic-card" href="{{ $dept->getUrl() }}"><span class="icon"><i class="fa fa-sitemap"></i></span><h3>@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</h3><p>{{ Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$dept->description,'en'=>$dept->descriptionEn])), 14) }}</p></a></div>
                    @endforeach
                </div></section>
            @endif
        </div>
        <aside class="col-md-4"><section class="academic-card college-quick-links">
            <h2>@lang('site.getContent', ['ar' => 'روابط سريعة', 'en' => 'Quick links'])</h2>
            <a href="{{ route('college.display', ['slug'=>$college->slug,'section'=>'about']) }}">@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a>
            @if($college->details && ($college->details->dean_name || $college->hasDetails('deanWord')))<a href="{{ route('college.display', ['slug'=>$college->slug,'section'=>'dean']) }}">@lang('site.getContent',['ar'=>$college->type->deanshipWordTitle, 'en'=>$college->type->deanshipWordTitleEn])</a>@endif
            @if($college->staff->count())<a href="{{ route('college.display', ['slug'=>$college->slug,'section'=>'staff']) }}">@lang('site.staff')</a>@endif
            @if($college->details && $college->hasDetails('programs'))<a href="{{ route('college.display', ['slug'=>$college->slug,'section'=>'programs']) }}">@lang('site.programs')</a>@endif
        </section></aside>
    </div></div></main>
@stop
