@extends('site.layouts.college')

@section('content')

    <!-- Slider -->
        @include('site.collegeSlider')
    <!-- end Slider -->
   
    <!-- Content -->
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @if($college->professors->count() > 0)
                        <aside id="our-professors">
                            <header>
                                <h2>@lang('site.professors')</h2>
                            </header>
                            <div class="section-content">
                                <div class="professors">
                                    @foreach($college->professors->take(3) as $prof)
                                        <article class="professor-thumbnail">
                                           <figure class="professor-image"><a href="{{ url($college->slug.'/prof/'.$prof->id) }}"><img src="{{ asset('universo/assets/img/professor.jpg') }}" alt="{{ $prof->trans('name','nameEn') }}"></a></figure>
                                            <aside>
                                                <header>
                                                   <a href="{{ url($college->slug.'/prof/'.$prof->id) }}">{{ $prof->trans('name','nameEn') }}</a>
                                                    <div class="divider"></div>
                                                    <figure class="professor-description">{{ $prof->trans('sp','spEn') }}</figure>
                                                </header>
                                               <a href="{{ url($college->slug.'/prof/'.$prof->id) }}" class="show-profile">{!! Lang::get('site.getContent',['ar'=>'عرض الملف الشخصي','en'=>'Show Profile']) !!}</a>
                                            </aside>
                                        </article><!-- /.professor-thumbnail -->
                                    @endforeach
                                    <a href="{{ url($college->slug.'/prof') }}" class="read-more">{!! Lang::get('site.getContent',['ar'=>'جميع الأساتذة','en'=>'All Professors']) !!}</a>                                </div><!-- /.professors -->
                            </div><!-- /.section-content -->
                        </aside><!-- /.our-professors -->
                    @endif
                    <section class="events small" id="events-small">
                        {{-- include('site.collegeSidebar') --}}
                        <header>
                            <h2>@lang('site.collegeNews',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</h2>
                        </header>
                        <div class="section-content">
                            @if($college->news->count() > 0)
                                @foreach($college->latestNews as $cnews)
                                    <article class="event nearest">
                                        <figure class="date">
                                            <div class="month">{{ date("M", strtotime($cnews->newsDate)) }}</div>
                                            <div class="day">{{ date("d", strtotime($cnews->newsDate)) }}</div>
                                        </figure>
                                        <aside>
                                            <header>
                                                <a href="#">{{ $cnews->title }}</a>
                                            </header>
                                            <div class="additional-info">
                                                {!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$cnews->txt, 'en' => $cnews->txt])),26) !!}
                                            </div>
                                        </aside>
                                    </article><!-- /article -->
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    @lang('site.noNews')
                                </div>
                            @endif
                        </div><!-- /.section-content -->
                    </section><!-- /.events-small -->
                </div><!-- /.col-md-3 -->
    
                <div class="col-md-9">
                    <section id="main-content">
                        <header>
                            <h2><i class="fa fa-fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i> @lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</h2>
                        </header>
                        <div class="section-content">
                            <p>
                                {!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$college->txt, 'en' => $college->txtEn])),50) !!}
                                <a class="btn btn-framed btn-small btn-color-grey-light" href="{{ $college->getUrl() }}/about">@lang('site.more')</a>
                            </p>
                        @if(isset($college->info->vision) || isset($college->info->mission) || isset($college->info->objectives))
                            <header>
                                <h2><i class="fa fa-fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i> @lang('site.VMO')</h2>
                            </header>
                            <div class="section-content">
                                @if(isset($college->info->vision))
                                    <h3>@lang('site.vision')</h3>
                                    <p>
                                        {!! Lang::get('site.getContent', ['ar'=>$college->info->vision, 'en' => $college->info->visionEn]) !!}
                                    </p>
                                @endif
                                @if(isset($college->info->vision))
                                    <h3>@lang('site.mission')</h3>
                                    <p>
                                        {!! Lang::get('site.getContent', ['ar'=>$college->info->mission, 'en' => $college->info->missionEn]) !!}
                                    </p>
                                    @endif
                                @if(isset($college->info->vision))
                                    <h3>@lang('site.objectives')</h3>
                                    <p>
                                        {!! Lang::get('site.getContent', ['ar'=>$college->info->objectives, 'en' => $college->info->objectivesEn]) !!}
                                    </p>
                                @endif
                            @endif
                            
                            @if($college->departments->count() > 0)
                                <h2><i class="fa fa-fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i> @lang('site.departments')</h2>
                                <div class="row">
                                    @foreach ($college->departments as $dept)
                                    <div class="col-md-6">
                                        <a href="{{ $dept->getUrl() }}" class="universal-button framed1">
                                            <h3>@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</h3>
                                            <figure class="date"><i class="fa fa-arrow-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i></figure>
                                        </a><!-- /.universal-button -->
                                    </div><!-- /.col-md-6 -->
                                    @endforeach
                                </div><!-- /.row -->
                            @endif
        
                        </div><!-- /.section-content -->
                    </section><!-- /.main-content -->
                </div><!-- /.col-md-6 -->
    
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- end Content -->
@stop