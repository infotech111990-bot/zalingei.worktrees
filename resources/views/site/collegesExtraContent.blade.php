@extends('site.layouts.college')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">@lang('site.home')</a></li>
        <li><a href="#">{{ $college->extraDetails()->find($id)->trans('title','titleEn')  }}</a></li>
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
                            <h1>
                                <i class="fa fa-fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i> 
                                {{ $college->extraDetails()->find($id)->trans('title','titleEn') }}
                        </header>
                        <div class="section-content">
                            <p>
                                {!! $college->extraDetails()->find($id)->trans('txt','txtEn') !!}
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