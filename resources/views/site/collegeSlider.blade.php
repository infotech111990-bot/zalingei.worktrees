<div id="slider">
    <div class="container">
        <div class="slider-wrapper">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="image-carousel" dir="ltr">
                            <div class="slide" dir="@lang('site.getContent', ['ar'=>'rtl', 'en' => 'ltr'])">
                                <div class="col-md-4 col-sm-4">
                                    <h2>@lang('site.welcome')..</h2>
                                    <div class="alert alert-success">
                                        <strong> @lang('site.getContent', ['ar'=>$college->title, 'en' => $college->titleEn]) </strong>
                                    </div>
                                    <p style="text-align: justify;">
                                        {!! Str::words(strip_tags(Lang::get('site.getContent', ['ar'=>$college->txt, 'en' => $college->txtEn])),26) !!}
                                    </p>
                                    <a href="{{ $college->getUrl() }}/about" class="btn btn-framed btn-small btn-color-white">@lang('site.more')</a>
                                </div><!-- /.col-md-4 -->
                                <div class="col-md-8 col-sm-8">
                                    <div class="image-carousel-slide">
                                        <img style="height:320px; width:100%; border:1px solid #CCC;" src="{{ $college->getPicture()  }}" alt="">
                                    </div>
                                </div><!-- /.col-md-8 -->
                            </div><!-- /.slide -->
                            @if($college->slider->count() > 0)
                                @foreach($college->slider as $slider)
                                    <div class="slide" dir="rtl">
                                        <div class="col-md-4 col-sm-4">
                                            <h1>{{ $slider->line1 }}</h1>
                                            <p>
                                                {{ $slider->line2 }}
                                            </p>
                                            <a href="#" class="btn btn-framed btn-small btn-color-white">View Details</a>
                                        </div><!-- /.col-md-4 -->
                                        <div class="col-md-8 col-sm-8">
                                            <div class="image-carousel-slide"><img style="height: 320px; width: 555px;" src="{{ $slider->getPicture() }}" alt=""></div>
                                        </div><!-- /.col-md-8 -->
                                    </div><!-- /.slide -->
                                @endforeach
                            @endif
                            </div><!-- /.image-carousel -->
                    </div><!-- /.row -->
                </div><!-- /.col-md-9 -->

                <div class="col-md-3 col-sm-12">
                    <aside class="news-small" id="news-slider">
                        <header>
                            <h2><i class="fa fw fa-angle-double-@lang('site.getContent',['ar'=>'left','en'=>'right'])"></i> @lang('site.collegeAnnouncements',['ar'=>$college->type->titleSingle,'en'=>$college->type->titleSingleEn])</h2>
                        </header>
                        <div class="section-content">
                            @if($college->announcements->count() > 0)
                                @foreach($college->announcements->take(3) as $announcement)
                                    <article>
                                        <header>
                                            <i class="fa fa-file-o"></i>
                                            <a href="{{ $announcement->getUrl() }}">
                                                @lang('site.getContent', ['ar'=>$announcement->title, 'en'=>$announcement->titleEn])
                                            </a>
                                        </header>
                                    </article><!-- /article -->
                                @endforeach
                                <a href="{{ url($college->slug.'/announcements') }}" class="read-more">@lang('site.more')</a>
                            @else
                                    <div class="alert alert-warning alert-dismissible" role="alert">
                                        <i class="fa fa-eye"></i>
                                        @lang('site.noAnnouncements')
                                    </div>
                            @endif
                        </div><!-- /.section-content -->
                    </aside><!-- /.news-small -->
                </div><!-- /.col-md-3 -->

            </div><!-- /.row -->
        </div><!-- /.slider-wrapper -->
    </div><!-- /.container -->
</div>
