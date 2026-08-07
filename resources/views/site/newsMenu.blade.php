@if($mostReadNews->count() > 0 && $latestNews->count() > 0)

    <aside class="news-small" id="news-small">
        <header>
            <h2>@lang('site.mostReadNews')</h2>
        </header>
        <div class="section-content">
            @foreach($mostReadNews as $mrNews)
                <article>
                    <figure class="date">
                        <i class="fa fa-clock-o"></i>
                        {{ date("Y-m-d",strtotime($mrNews->news_date)) }} | 
                        <i class="fa fa-eye"></i>
                        {{ number_format($mrNews->readingCount) }}
                    </figure>
                    <header><a href="{{ $mrNews->getUrl() }}">
                        @lang('site.getContent',['ar'=>$mrNews->title,'en'=>$mrNews->titleEn])    
                    </a></header>
                </article><!-- /article -->
                @endforeach
        </div><!-- /.section-content -->
        <a href="{{ url('/') }}/news" class="read-more">@lang('site.allNews')</a>
    </aside><!-- /.news-small -->

@endif