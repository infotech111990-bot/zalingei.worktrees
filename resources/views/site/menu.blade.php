<?php
$pages = App\Page::where('parent_id',0)->where('publish',1)
    ->orderBy('order','ASC')->orderBy('id','asc')->get();
?>
<header class="zr-navbar">
    <div class="container">
        <div class="zr-nav-inner">
            <a class="zr-brand" href="{{ url('/') }}" aria-label="@lang('site.siteName')">
            <img src="{{ asset('universo/assets/img/logo.png') }}" alt="@lang('site.siteName')" style="max-height:62px; vertical-align:middle; margin-right:10px;">
                <span class="zr-brand-text">
                    <strong>@lang('site.siteName')</strong>
                    <small>@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'University of Zalingei'])</small>
                </span>
            </a>

            <button class="navbar-toggle zr-toggle" type="button" data-toggle="collapse" data-target="#zr-main-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span></span><span></span><span></span>
            </button>

            <nav id="zr-main-nav" class="collapse navbar-collapse zr-main-nav">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> @lang('site.home')</a></li>
                    @foreach ($pages as $page)
                        <li class="@if($page->hasChild() || in_array($page->id,[21,22,23,99])) dropdown @endif">
                            <a href="@if($page->hasChild() || in_array($page->id,[21,22,23,99])) javascript:void(0) @else {{$page->getLink()}} @endif"
                               class="@if($page->hasChild() || in_array($page->id,[21,22,23,99])) dropdown-toggle @endif"
                               @if($page->hasChild() || in_array($page->id,[21,22,23,99])) data-toggle="dropdown" @endif>
                                @lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])
                                @if($page->hasChild() || in_array($page->id,[21,22,23,99])) <span class="caret"></span> @endif
                            </a>

                            @if($page->hasChild())
                                <ul class="dropdown-menu zr-dropdown">
                                    @foreach($page->children as $children)
                                        <li><a href="{{$children->getLink()}}">@lang('site.getContent',['ar'=>$children->title,'en'=>$children->titleEn])</a></li>
                                    @endforeach
                                </ul>
                            @endif

                            @if(in_array($page->id,[21,22,23,99]))
                                <ul class="dropdown-menu zr-dropdown zr-college-menu">
                                    @php
                                        $collegeQuery = App\College::query();
                                        if ($page->id == 21) $collegeQuery->where('colleges_type_id',1);
                                        if ($page->id == 22) $collegeQuery->whereIn('colleges_type_id',[2,6]);
                                        if ($page->id == 23) $collegeQuery->whereIn('colleges_type_id',[4,5]);
                                        if ($page->id == 99) $collegeQuery->whereIn('colleges_type_id',[3,7]);
                                    @endphp
                                    @foreach($collegeQuery->orderBy('colleges_type_id','asc')->get() as $menuCollege)
                                        <li><a href="{{$menuCollege->getUrl()}}">@lang('site.getContent',['ar'=>$menuCollege->title,'en'=>$menuCollege->titleEn])</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    <li><a href="{{ url('news') }}"><i class="fa fa-newspaper-o"></i> @lang('site.news')</a></li>
                    <li><a href="{{ url('student-portal') }}" class="zr-nav-portal"><i class="fa fa-graduation-cap"></i> @lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'Student Portal'])</a></li>
                    <li><a href="https://me.classera.com/" class="zr-nav-e-learning" target="_blank" rel="noopener noreferrer"><i class="fa fa-laptop"></i> @lang('site.getContent',['ar'=>'التعلم الإلكتروني','en'=>'E-Learning'])</a></li>
                    <li><a href="{{ url('contactUs') }}"><i class="fa fa-phone"></i> @lang('site.contactUs')</a></li>
                </ul>
            </nav>

            <a class="zr-search-btn" href="{{ route('search','all') }}" aria-label="Search"><i class="fa fa-search"></i></a>
        </div>
    </div>
</header>
