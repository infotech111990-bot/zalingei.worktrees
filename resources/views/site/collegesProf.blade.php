@extends('site.layouts.college')

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">@lang('site.home')</a></li>
            <li><a href="#">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</a></li>
            <li><a class="active">@lang('site.professors')</a></li>
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
                                @lang('site.professors')
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
                            <section>
                                <table class="table table-condensed table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.name') }}</th>
                                            <th>{{ __('admin.degree') }}</th>
                                            <th>{{ __('site.department') }}</th>
                                            <th>{{ __('admin.sp') }}</th>
                                            <th>{{ __('admin.subSp') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($college->staff()->where('is_prof',1)->orderBy('staff_degree_id','asc')->get() as $staff)
                                            <tr>
                                                <td><a href="{{ $staff->getUrl() }}">@lang('site.getContent', ['ar'=>$staff->name, 'en'=>$staff->nameEn])</a></td>
                                                <td>{{ $staff->degree->title }}</td>
                                                <td>@if($staff->department) {{ __('site.getContent', ['ar' => $staff->department->title, 'en' => $staff->department->titleEn]) }} @endif</td>
                                                <td>{{ $staff->sp }}</td>
                                                <td>{{ $staff->subSp }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </section>
                            {{-- <section id="our-speakers">
                                @foreach($college->staff()->orderBy('staff_degree_id','asc')->get() as $staff)
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
                            </section> --}}
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