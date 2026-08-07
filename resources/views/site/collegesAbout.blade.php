@extends('site.layouts.college')

@section('content')

<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
        <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
        <li><a class="active">@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
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
                                @lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])
                            </h2>
                        </header>
                        <div class="section-content">
                            <img src="{{ $college->getPicture() }}" class="thumbnail img-responsive center-block" />
                            <p>
                                {!! Lang::get('site.getContent', ['ar'=>$college->txt, 'en' => $college->txtEn]) !!}
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