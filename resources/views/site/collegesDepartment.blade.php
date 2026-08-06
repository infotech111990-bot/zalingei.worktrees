@extends('site.layouts.college')

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ request()->root() }}">@lang('site.home')</a></li>
            <li><a href="{{ $college->getUrl() }}">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
            <li><a class="active">@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</a></li>
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
                                {{-- @lang('site.department'):  --}}
                                @lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])
                            </h2>
                        </header>
                        <div class="section-content">
                            <style>
                                .thumbnail {
                                    position: relative;
                                }

                                .caption {
                                    position: absolute;
                                    top: 45%;
                                    left: 0;
                                    font-size: 42px;
                                    color: #FFF;
                                    font-weight: 500;
                                    width: 100%;
                                }
                            </style>
                            <div class="row" id="box-search">
                                <div class="thumbnail text-center">
                                    <img src="{{ request()->root() }}/public/includes/colleges/departments/1/zunv-department-bg.jpg" alt="" class="img-responsive btn-block">
                                    <div class="caption">
                                        <p>@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</p>
                                    </div>
                                </div>
                            </div>
                            <section id="course-tabs">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs course-detail-tabs">
                                    <li class="active"><a href="#tab-about" data-toggle="tab">@lang('site.aboutDepartment')</a></li>
                                    @if(isset($dept->objectives) && $dept->objectives != '' && $dept->objectives != '<p dir="rtl"><br></p>') <li><a href="#tab-objectives" data-toggle="tab">@lang('site.objectives')</a></li> @endif
                                    @if(isset($dept->degrees) && $dept->degrees != '' && $dept->degrees != '<p dir="rtl"><br></p>') <li><a href="#tab-degrees" data-toggle="tab">@lang('site.degrees')</a></li> @endif
                                    @if(isset($dept->email) || isset($dept->phone)) <li><a href="#tab-contact" data-toggle="tab">@lang('site.contactUs')</a></li> @endif
                                    @if($dept->staff->count() > 0) <li><a href="#tab-staff" data-toggle="tab">@lang('site.staff')</a></li> @endif
                                </ul><!-- /.course-detail-tabs -->

                                <!-- Tab panes -->
                                <div class="tab-content course-tab-content">
                                    <div class="tab-pane fade in active" id="tab-about">
                                        <section class="course-schedule">
                                            <article class="course-schedule-block">
                                                <header><h4>@lang('site.aboutDepartment'):</h4></header>
                                                        <p class="description">
                                                            {!! Lang::get('site.getContent', ['ar' => $dept->txt, 'en' => $dept->txtEn]) !!}
                                                        </p>
                                            </article><!-- /.course-schedule-block -->
                                        </section><!-- /#tab-schedule -->
                                    </div>
                                    @if(isset($dept->objectives))
                                    <div class="tab-pane fade" id="tab-objectives">
                                        <section class="course-schedule">
                                            <article class="course-schedule-block">
                                                <header><h4>@lang('site.objectives'):</h4></header>
                                                        <p class="description">
                                                            {!! Lang::get('site.getContent', ['ar' => $dept->objectives, 'en' => $dept->objectivesEn]) !!}
                                                        </p>
                                            </article><!-- /.course-schedule-block -->
                                        </section><!-- /#tab-schedule -->
                                    </div>
                                    @endif
                                    @if(isset($dept->degrees))
                                    <div class="tab-pane fade" id="tab-degrees">
                                        <section class="course-schedule">
                                            <article class="course-schedule-block">
                                                <header><h4>@lang('site.degrees'):</h4></header>
                                                        <p class="description">
                                                            {!! Lang::get('site.getContent', ['ar' => $dept->degrees, 'en' => $dept->degreesEn]) !!}
                                                        </p>
                                            </article><!-- /.course-schedule-block -->
                                        </section><!-- /#tab-schedule -->
                                    </div>
                                    @endif
                                    @if(isset($dept->email) || isset($dept->phone))
                                    <div class="tab-pane fade" id="tab-contact">
                                        <section class="course-schedule">
                                            <article class="course-schedule-block">
                                                <header><h4>@lang('site.contactUs'):</h4></header>
                                                <p></p>
                                                <div class="alert alert-info">
                                                    <p class="description">
                                                        <strong><i class="fa fa-fw fa-envelope"></i> @lang('site.email'):</strong> {{ $dept->email }}
                                                    </p>
                                                    <p class="description">
                                                        <strong><i class="fa fa-fw fa-phone"></i> @lang('site.phone'):</strong> {{ $dept->phone }}
                                                    </p>
                                                </div>
                                            </article><!-- /.course-schedule-block -->
                                        </section><!-- /#tab-schedule -->
                                    </div>
                                    @endif
                                    @if($dept->staff->count() > 0)
                                    <div class="tab-pane fade" id="tab-staff">
                                        <section class="course-schedule">
                                            <article class="course-schedule-block">
                                                <header><h4>@lang('site.staff'):</h4></header>
                                                @foreach($dept->staff()->orderBy('staff_degree_id','asc')->get() as $staff)
                                                <div class="author-block course-speaker">
                                                    <a href="{{ $staff->getUrl() }}"><figure class="author-picture"><img src="{{ $staff->getPicture() }}" alt=""></figure></a>
                                                    <article class="paragraph-wrapper">
                                                        <div class="inner">
                                                            <header><a href="{{ $staff->getUrl() }}">@lang('site.getContent', ['ar'=>$staff->name, 'en'=>$staff->nameEn])</a></header>
                                                            <figure>{{ $staff->degree->title }}</figure>
                                                            <a href="{{ $staff->getUrl() }}" class="btn btn-framed btn-small btn-color-grey">@lang('site.details')</a>
                                                        </div>
                                                    </article>
                                                </div><!-- /.author -->
                                            @endforeach
                                            </article><!-- /.course-schedule-block -->
                                        </section><!-- /#tab-schedule -->
                                    </div>
                                    @endif
                                </div><!-- /Tab panes -->
                            </section><!-- /#course-tabs -->
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