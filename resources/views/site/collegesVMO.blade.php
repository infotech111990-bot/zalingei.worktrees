@extends('site.layouts.college')

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ url('/') }}">@lang('site.home')</a></li>
            <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
            <li><a class="active">@lang('site.VMO')</a></li>
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
                                @lang('site.VMO')
                            </h2>
                        </header>
                        <div class="section-content">
                            @if($college->details)
                                @if(isset($college->details->vision) || isset($college->details->mission) || isset($college->details->objectivesEn))
                                <div class="section-content">
                                    @if(isset($college->details->vision))
                                        <h2>@lang('site.vision')</h2>
                                        <p>
                                            {!! Lang::get('site.getContent', ['ar'=>$college->details->vision, 'en' => $college->details->visionEn]) !!}
                                        </p>
                                    @endif
                                    @if(isset($college->details->mission))
                                        <h2>@lang('site.mission')</h2>
                                        <p>
                                            {!! Lang::get('site.getContent', ['ar'=>$college->details->mission, 'en' => $college->details->missionEn]) !!}
                                        </p>
                                        @endif
                                    @if(isset($college->details->objectives))
                                        <h2>@lang('site.objectives')</h2>
                                        <p>
                                            {!! Lang::get('site.getContent', ['ar'=>$college->details->objectives, 'en' => $college->details->objectivesEn]) !!}
                                        </p>
                                    @endif
                                @endif
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