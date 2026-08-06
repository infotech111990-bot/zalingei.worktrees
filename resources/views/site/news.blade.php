@extends('site.layouts.master')

@section('content')
<div class="zr-page-hero">
    <div class="container">
        <span class="zr-eyebrow">@lang('site.getContent',['ar'=>'آخر المستجدات','en'=>'LATEST UPDATES'])</span>
        <h1>@lang('site.news')</h1>
        <p>@lang('site.getContent',['ar'=>'تابع أخبار وإعلانات جامعة زالنجي أولاً بأول.','en'=>'Follow the latest news and announcements from the University of Zalingei.'])</p>
    </div>
</div>

<div id="page-content" class="zr-inner-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section class="zr-content-section">
                    <div class="row">
                        @foreach($news as $n)
                            <div class="col-md-6 col-sm-6">
                                <article class="zr-news-card zr-news-card-page">
                                    <a class="zr-news-image" href="{{ $n->getUrl() }}">
                                        <img src="{{ $n->getPicture() }}" alt="">
                                        <span class="zr-news-date"><b>{{ date('d',strtotime($n->newsDate)) }}</b><small>{{ date('M',strtotime($n->newsDate)) }}</small></span>
                                    </a>
                                    <div class="zr-news-body">
                                        <span class="zr-card-label">@lang('site.news')</span>
                                        <h3><a href="{{ $n->getUrl() }}">@lang('site.getContent',['ar'=>$n->title,'en'=>$n->titleEn])</a></h3>
                                        <p>{!! Str::words(strip_tags(Lang::get('site.getContent',['ar'=>$n->txt,'en'=>$n->txtEn])),34) !!}</p>
                                        <a class="zr-read-more" href="{{ $n->getUrl() }}">@lang('site.more') <i class="fa fa-arrow-left"></i></a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    <div class="zr-pagination">{{ $news->links() }}</div>
                </section>
            </div>
            <div class="col-md-3">
                <aside class="zr-sidebar">
                    <h3>@lang('site.getContent',['ar'=>'بحث في الموقع','en'=>'Search the site'])</h3>
                    <form action="{{ route('search','all') }}" class="zr-search-form">
                        <input type="text" name="keywords" placeholder="@lang('site.getContent',['ar'=>'كلمات البحث','en'=>'Search keywords'])">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    @include('site.newsMenu')
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
