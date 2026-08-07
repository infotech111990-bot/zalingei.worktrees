@extends('site.layouts.college')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
        <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
        <li><a class="active">@lang('site.collegeNews',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
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
                                @lang('site.collegeNews',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])
                            </h2>
                        </header>
                        <div class="section-content">
                            @if($college->news->count() > 0)
                                @foreach($college->news as $cnews)
                                    <article class="blog-post">
                                        <div class="blog-post-image">
                                            <a href="{{ url('/') }}/{{ $college->slug }}/news/{{ $cnews->id }}">
                                                <img src="{{ $cnews->getPicture() }}" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-post-content">
                                            <h3><a href="{{ url('/') }}/{{ $college->slug }}/news/{{ $cnews->id }}">@lang('site.getContent',['ar'=>$cnews->title,'en'=>$cnews->titleEn])</a></h3>
                                            <p>{!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$cnews->txt, 'en' => $cnews->txtEn])),40) !!}</p>
                                            <a href="{{ url('/') }}/{{ $college->slug }}/news/{{ $cnews->id }}" class="read-more">@lang('site.more')</a>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <div class="alert alert-warning">@lang('site.getContent',['ar'=>'لا توجد أخبار منشورة حالياً.','en'=>'No published news yet.'])</div>
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