@extends('site.layouts.college')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
        <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
        <li class="active">@lang('site.collegeAnnouncements',['ar'=>$college->type->titleSingle,'en'=>$college->type->titleSingleEn])</li>
    </ol>
</div>
<!-- end Breadcrumb -->

<!-- Content -->
<div class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <section id="main-content">
                    <header>
                        <h2>
                            <i class="fa fa-fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i>
                            @lang('site.collegeAnnouncements',['ar'=>$college->type->titleSingle,'en'=>$college->type->titleSingleEn])
                        </h2>
                    </header>
                    <div class="section-content">
                        @if($college->announcements->count() > 0)
                            @foreach($college->announcements as $announcement)
                                <article class="blog-post">
                                    <div class="blog-post-image">
                                        <a href="{{ $announcement->getUrl() }}">
                                            <img src="{{ $announcement->getPicture() }}" alt="">
                                        </a>
                                    </div>
                                    <div class="blog-post-content">
                                        <h3><a href="{{ $announcement->getUrl() }}">@lang('site.getContent',['ar'=>$announcement->title,'en'=>$announcement->titleEn])</a></h3>
                                        <span class="blog-post-meta">{{ date('M d, Y', strtotime($announcement->created_at)) }}</span>
                                        <p>{!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$announcement->txt, 'en' => $announcement->txtEn])),40) !!}</p>
                                        <a href="{{ $announcement->getUrl() }}" class="read-more">@lang('site.more')</a>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <div class="alert alert-warning">@lang('site.getContent',['ar'=>'لا توجد إعلانات منشورة حالياً.','en'=>'No published announcements yet.'])</div>
                        @endif
                    </div><!-- /.section-content -->
                </section><!-- /.main-content -->
            </div><!-- /.col-md-9 -->
            <div class="col-md-3">
                @include('site.collegeSidebar')
            </div><!-- /.col-md-3 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- end Content -->

@stop
