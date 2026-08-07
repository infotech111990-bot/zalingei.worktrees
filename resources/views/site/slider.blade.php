@php
    $slides = App\Slides::getSlides();
@endphp

<section class="zr-hero">
    @if($slides->count())
        <div class="flexslider zr-hero-slider">
            <ul class="slides">
                @foreach ($slides as $slide)
                    <li class="zr-hero-slide">
                        <img src="{{ $slide->getPicture() }}" alt="">
                        <div class="zr-hero-overlay"></div>
                        <div class="zr-hero-content container">
                            <span class="zr-kicker">@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'University of Zalingei'])</span>
                            <h1>{{ $slide->headerTwo }}</h1>
                            @if($slide->headerOne)<p>{{ $slide->headerOne }}</p>@endif
                            @if($slide->url)
                                <a href="{{ $slide->url }}" class="zr-btn zr-btn-light" target="_blank">@lang('site.more') <i class="fa fa-arrow-left"></i></a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="zr-hero-fallback">
            <div class="container zr-hero-content">
                <span class="zr-kicker">@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'University of Zalingei'])</span>
                <h1>@lang('site.siteName')</h1>
                <p>@lang('site.aboutUsDesc')</p>
                <a href="{{ url('/') }}/page/4/about-university-of-zalingie" class="zr-btn zr-btn-light">@lang('site.aboutUs') <i class="fa fa-arrow-left"></i></a>
            </div>
        </div>
    @endif
    <div class="zr-hero-scroll"><i class="fa fa-angle-down"></i></div>
</section>
