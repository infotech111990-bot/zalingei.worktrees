@extends('site.layouts.college')

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ request()->root() }}">@lang('site.home')</a></li>
            <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
            <li><a class="active">@lang('site.programs')</a></li>
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
                                @lang('site.programs')
                            </h2>
                        </header>
                        <div class="section-content">
                            <p>
                            @if($college->details)
                                {!! Lang::get('site.getContent', ['ar'=>$college->details->programs, 'en' => $college->details->calendarEn]) !!}
                            @endif
                            </p>
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