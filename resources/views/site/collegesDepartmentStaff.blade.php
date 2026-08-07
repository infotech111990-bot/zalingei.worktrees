@extends('site.layouts.college')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
        <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
        <li><a class="active">@lang('site.staff')</a></li>
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
                                @lang('site.staff')
                            </h2>
                        </header>
                        <div class="section-content">
                            @if($college->staff->count() > 0)
                                <div class="row">
                                    @foreach($college->staff as $member)
                                        <div class="col-md-4 col-sm-6">
                                            <article class="professor-thumbnail">
                                                <figure class="professor-image">
                                                    <a href="{{ url('/') }}/staff/{{ $member->id }}">
                                                        <img src="{{ $member->getPicture() }}" alt="">
                                                    </a>
                                                </figure>
                                                <aside>
                                                    <header>
                                                        <a href="{{ url('/') }}/staff/{{ $member->id }}">@lang('site.getContent',['ar'=>$member->name,'en'=>$member->nameEn])</a>
                                                        <div class="divider"></div>
                                                        <figure class="professor-description">@lang('site.getContent',['ar'=>$member->sp,'en'=>$member->spEn])</figure>
                                                    </header>
                                                    <a href="{{ url('/') }}/staff/{{ $member->id }}" class="show-profile">@lang('site.more')</a>
                                                </aside>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-warning">@lang('site.getContent',['ar'=>'لا يوجد أعضاء هيئة تدريس.','en'=>'No staff members.'])</div>
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