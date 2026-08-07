@extends('site.layouts.master')

@section('content')
@php
    $locale = Config::get('app.locale');
    $lang = $locale == 'ar' ? 1 : 2;
    $latestNews = App\News::where('lang',$lang)->orderBy('created_at','desc')->limit(4)->get();
@endphp

<div class="zr-portal-hero">
    <div class="container">
        <div class="zr-portal-hero-inner">
            <span class="zr-eyebrow zr-eyebrow-light">@lang('site.getContent',['ar'=>'خدمات الطلاب','en'=>'STUDENT SERVICES'])</span>
            <h1>@lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'Student Portal'])</h1>
            <p>@lang('site.getContent',['ar'=>'مرحباً بك في بوابة الطالب بجامعة زالنجي — سجل بياناتك، واستعلم عن نتائجك بسهولة وأمان.','en'=>'Welcome to the University of Zalingei Student Portal — register your data and check your results easily and securely.'])</p>
        </div>
    </div>
    <div class="zr-portal-shape"></div>
</div>

@if(session('success'))
    <div class="container zr-flash-wrap">
        <div class="zr-flash zr-flash-success">
            <i class="fa fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<main class="zr-portal-main">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <a class="zr-portal-card zr-portal-card-register" href="{{ route('student.register') }}">
                    <div class="zr-portal-icon"><i class="fa fa-user-plus"></i></div>
                    <div class="zr-portal-card-body">
                        <span class="zr-eyebrow">@lang('site.getContent',['ar'=>'التسجيل','en'=>'REGISTRATION'])</span>
                        <h2>@lang('site.getContent',['ar'=>'تسجيل الطلاب','en'=>'Student Registration'])</h2>
                        <p>@lang('site.getContent',['ar'=>'سجل بياناتك الأكاديمية بسهولة وأمان للانضمام إلى سجل طلاب الجامعة.','en'=>'Register your academic data easily and securely to join the university student registry.'])</p>
                        <span class="zr-portal-link">@lang('site.getContent',['ar'=>'ابدأ التسجيل','en'=>'Start Registration']) <i class="fa fa-arrow-left"></i></span>
                    </div>
                    <div class="zr-portal-bg-icon"><i class="fa fa-graduation-cap"></i></div>
                </a>
            </div>

            <div class="col-md-6 col-sm-12">
                <a class="zr-portal-card zr-portal-card-results" href="{{ route('student.results') }}">
                    <div class="zr-portal-icon"><i class="fa fa-file-text-o"></i></div>
                    <div class="zr-portal-card-body">
                        <span class="zr-eyebrow">@lang('site.getContent',['ar'=>'النتائج','en'=>'RESULTS'])</span>
                        <h2>@lang('site.getContent',['ar'=>'نتائج الطلاب','en'=>'Student Results'])</h2>
                        <p>@lang('site.getContent',['ar'=>'استعلم عن نتائجك الدراسية الفصلية والنهائية باستخدام رقم الطالب.','en'=>'Check your semester and final academic results using your student number.'])</p>
                        <span class="zr-portal-link">@lang('site.getContent',['ar'=>'عرض النتائج','en'=>'View Results']) <i class="fa fa-arrow-left"></i></span>
                    </div>
                    <div class="zr-portal-bg-icon"><i class="fa fa-list-alt"></i></div>
                </a>
            </div>
        </div>

        <div class="zr-portal-info">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="zr-info-item">
                        <i class="fa fa-headphones"></i>
                        <h3>@lang('site.getContent',['ar'=>'الدعم الفني','en'=>'Technical Support'])</h3>
                        <p>@lang('site.getContent',['ar'=>'إذا واجهت أي مشكلة في التسجيل أو الاستعلام، تواصل مع عمادة تقنية المعلومات.','en'=>'If you face any issue with registration or lookup, contact the IT Deanship.'])</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="zr-info-item">
                        <i class="fa fa-question-circle"></i>
                        <h3>@lang('site.getContent',['ar'=>'الأسئلة الشائعة','en'=>'FAQs'])</h3>
                        <p>@lang('site.getContent',['ar'=>'اعرف المزيد عن آلية التسجيل والاستعلام عن النتائج في الجامعة.','en'=>'Learn more about the registration and results lookup process at the university.'])</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="zr-info-item">
                        <i class="fa fa-shield"></i>
                        <h3>@lang('site.getContent',['ar'=>'الخصوصية والأمان','en'=>'Privacy & Security'])</h3>
                        <p>@lang('site.getContent',['ar'=>'بياناتك الشخصية محمية ولا يتم مشاركتها مع أي جهة خارجية.','en'=>'Your personal data is protected and never shared with third parties.'])</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="zr-portal-news">
            <div class="zr-section-head">
                <div>
                    <span class="zr-eyebrow">@lang('site.getContent',['ar'=>'مستجدات','en'=>'UPDATES'])</span>
                    <h2>@lang('site.getContent',['ar'=>'أخبار تهم الطلاب','en'=>'News for Students'])</h2>
                </div>
                <a class="zr-link" href="{{ url('/') }}/news">@lang('site.allNews') <i class="fa fa-arrow-left"></i></a>
            </div>
            <div class="row">
                @forelse($latestNews as $n)
                    <div class="col-md-3 col-sm-6">
                        <article class="zr-news-card">
                            <a class="zr-news-image" href="{{ $n->getUrl() }}">
                                <img src="{{ $n->getPicture() }}" alt="">
                            </a>
                            <div class="zr-news-body">
                                <h3><a href="{{ $n->getUrl() }}">@lang('site.getContent',['ar'=>$n->title,'en'=>$n->titleEn])</a></h3>
                                <p>{!! Str::words(strip_tags(__('site.getContent',['ar'=>$n->summary,'en'=>$n->summaryEn])),14) !!}</p>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-md-12"><div class="zr-empty">@lang('site.getContent',['ar'=>'لا توجد أخبار منشورة حالياً.','en'=>'No published news yet.'])</div></div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection