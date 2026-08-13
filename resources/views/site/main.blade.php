@extends('site.layouts.master')

@section('content')
@include('site.slider')

@php
    $locale = Config::get('app.locale');
    $lang = $locale == 'ar' ? 1 : 2;
    $latestNews = App\News::where('lang',$lang)->orderBy('created_at','desc')->limit(6)->get();
    $colleges = App\College::where('status',1)->orderBy('sort_order','asc')->orderBy('id','asc')->limit(4)->get();
@endphp

<main class="zr-home">
    <section class="zr-quickbar"><div class="container"><div class="row">
        <div class="col-md-3 col-sm-6"><a href="{{ route('student.portal') }}"><i class="fa fa-graduation-cap"></i><span>@lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'Student Portal'])<small>@lang('site.getContent',['ar'=>'التسجيل والنتائج','en'=>'Registration & Results'])</small></span></a></div>
        <div class="col-md-3 col-sm-6"><a href="{{ url('news') }}"><i class="fa fa-newspaper-o"></i><span>@lang('site.news')<small>@lang('site.latestNews')</small></span></a></div>
        <div class="col-md-3 col-sm-6"><a href="{{ route('elearning') }}"><i class="fa fa-laptop"></i><span>@lang('site.getContent',['ar'=>'التعلم الإلكتروني','en'=>'E-Learning'])<small>Classera</small></span></a></div>
        <div class="col-md-3 col-sm-6"><a href="{{ route('institutes.centers') }}"><i class="fa fa-building"></i><span>@lang('site.getContent',['ar'=>'المعاهد والمراكز','en'=>'Institutes & Centers'])<small>@lang('site.getContent',['ar'=>'البحث والوحدات','en'=>'Research & Units'])</small></span></a></div>
    </div></div></section>

    <section class="zr-section zr-section-news"><div class="container">
        <div class="zr-section-head"><div><span class="zr-eyebrow">@lang('site.getContent',['ar'=>'آخر المستجدات','en'=>'LATEST UPDATES'])</span><h2>@lang('site.latestNews')</h2></div><a class="zr-link" href="{{ url('news') }}">@lang('site.allNews') <i class="fa fa-arrow-left"></i></a></div>
        <div class="row">
            @forelse($latestNews as $n)
                <div class="col-md-4 col-sm-6"><article class="zr-news-card"><a class="zr-news-image" href="{{ $n->getUrl() }}"><img src="{{ $n->getPicture() }}" alt=""><span class="zr-news-date"><b>{{ date('d', strtotime($n->news_date ?: $n->created_at)) }}</b><small>{{ date('M', strtotime($n->news_date ?: $n->created_at)) }}</small></span></a><div class="zr-news-body"><span class="zr-card-label">@lang('site.news')</span><h3><a href="{{ $n->getUrl() }}">@lang('site.getContent',['ar'=>$n->title,'en'=>$n->titleEn])</a></h3><p>{!! Str::words(strip_tags(__('site.getContent',['ar'=>$n->txt,'en'=>$n->txtEn])),24) !!}</p><a class="zr-read-more" href="{{ $n->getUrl() }}">@lang('site.more') <i class="fa fa-arrow-left"></i></a></div></article></div>
            @empty
                <div class="col-md-12"><div class="zr-empty">@lang('site.getContent',['ar'=>'لا توجد أخبار منشورة حالياً.','en'=>'No published news yet.'])</div></div>
            @endforelse
        </div>
    </div></section>

    <section class="zr-section zr-director"><div class="container"><div class="zr-director-card"><div class="row">
        <div class="col-md-4"><div class="zr-director-image"><img src="{{ __('site.VCPic') }}" alt="@lang('site.VCSpeachTitle')"><span>@lang('site.getContent',['ar'=>'كلمة مدير الجامعة','en'=>'Message from the Rector'])</span></div></div>
        <div class="col-md-8"><span class="zr-eyebrow">@lang('site.getContent',['ar'=>'رسالة الجامعة','en'=>'UNIVERSITY MESSAGE'])</span><h2>{{ __('site.VCSpeachTitle') }}</h2><div class="zr-director-text">{!! __('site.VCSpeachTxt') !!}</div><a class="zr-btn zr-btn-primary" href="{{ url('/') }}/page/100">@lang('site.more') <i class="fa fa-arrow-left"></i></a></div>
    </div></div></div></section>

    <section class="zr-section zr-systems"><div class="container"><div class="zr-section-head"><div><span class="zr-eyebrow">@lang('site.getContent',['ar'=>'خدمات رقمية','en'=>'DIGITAL SERVICES'])</span><h2>{{ __('site.universitySystems') }}</h2></div></div><div class="row">
        <div class="col-md-4 col-sm-6"><a class="zr-system-card" target="_blank" rel="noopener" href="http://41.67.48.106/ojs"><span class="zr-system-icon"><i class="fa fa-book"></i></span><span><b>@lang('site.getContent',['ar'=>'المجلات العلمية','en'=>'Scientific Journals'])</b><small>OJS</small></span><i class="fa fa-arrow-left"></i></a></div>
        <div class="col-md-4 col-sm-6"><a class="zr-system-card" target="_blank" rel="noopener" href="http://41.67.48.106:8090"><span class="zr-system-icon"><i class="fa fa-university"></i></span><span><b>@lang('site.getContent',['ar'=>'المكتبة الرقمية','en'=>'Digital Library'])</b><small>KOHA</small></span><i class="fa fa-arrow-left"></i></a></div>
        <div class="col-md-4 col-sm-6"><a class="zr-system-card" target="_blank" rel="noopener" href="http://41.67.48.106:8080/jspui"><span class="zr-system-icon"><i class="fa fa-database"></i></span><span><b>@lang('site.getContent',['ar'=>'المستودع الرقمي','en'=>'Digital Repository'])</b><small>DSpace</small></span><i class="fa fa-arrow-left"></i></a></div>
    </div></div></section>

    <section class="zr-section zr-colleges" style="background:#f7fbff;"><div class="container">
        <div class="zr-section-head"><div><span class="zr-eyebrow">@lang('site.getContent',['ar'=>'التعليم الأكاديمي','en'=>'ACADEMIC EDUCATION'])</span><h2>@lang('site.getContent',['ar'=>'الكليات','en'=>'Faculties'])</h2></div><a class="zr-link" href="{{ route('faculties') }}">@lang('site.getContent',['ar'=>'عرض جميع الكليات','en'=>'View all faculties']) <i class="fa fa-arrow-left"></i></a></div>
        <div class="row">
            @foreach($colleges as $college)
                <div class="col-md-3 col-sm-6"><a class="zr-college-card" href="{{ $college->getUrl() }}" style="display:block;background:linear-gradient(135deg,#f7fbff 0%,#edf6fc 100%);border:1px solid #cfe4f0;border-radius:18px;box-shadow:0 12px 30px rgba(12,91,143,.10);"><div class="zr-college-image" style="height:170px;background:linear-gradient(135deg,rgba(12,91,143,.16),rgba(15,139,141,.16));overflow:hidden;"><img src="{{ $college->getPicture() }}" alt="" style="width:100%;height:100%;object-fit:cover;"></div><div class="zr-college-body" style="position:relative;padding:16px 18px 20px;"><span style="font-size:10px;color:#0c5b8f!important;font-weight:800;">@lang('site.getContent',['ar'=>'كلية','en'=>'Faculty'])</span><h3 style="font-size:15px;line-height:1.6;margin:5px 25px 0 0;font-weight:800;color:#082c4c!important;">@lang('site.getContent',['ar'=>$college->name_ar,'en'=>$college->name_en])</h3><i class="fa fa-arrow-left" style="position:absolute;inset-inline-end:18px;bottom:22px;color:#0c5b8f!important;"></i></div></a></div>
            @endforeach
        </div>
    </div></section>

    <section class="zr-cta"><div class="container"><div><span class="zr-eyebrow">@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'UNIVERSITY OF ZALINGEI'])</span><h2>@lang('site.getContent',['ar'=>'معرفة، بحث، وخدمة للمجتمع','en'=>'Knowledge, research and service to the community'])</h2></div><a href="{{ route('about') }}" class="zr-btn zr-btn-light">@lang('site.aboutUs') <i class="fa fa-arrow-left"></i></a></div></section>
</main>
@endsection
