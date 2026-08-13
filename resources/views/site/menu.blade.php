<?php
$pages = App\Page::where('parent_id',0)->where('publish',1)
    ->whereNotIn('id',[21,22,23,99])
    ->orderBy('order','ASC')->orderBy('id','asc')->get();
?>
<header class="zr-navbar">
    <div class="container">
        <div class="zr-nav-inner">
            <a class="zr-brand" href="{{ url('/') }}" aria-label="@lang('site.siteName')">
                <img src="{{ asset('universo/assets/img/logo.png') }}" alt="@lang('site.siteName')" style="max-height:58px;vertical-align:middle;">
            </a>
            <button class="navbar-toggle zr-toggle" type="button" data-toggle="collapse" data-target="#zr-main-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span><span></span><span></span><span></span>
            </button>
            <nav id="zr-main-nav" class="collapse navbar-collapse zr-main-nav">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> @lang('site.home')</a></li>
                    <li><a href="{{ route('faculties') }}"><i class="fa fa-university"></i> @lang('site.getContent',['ar'=>'الكليات','en'=>'Faculties'])</a></li>
                    <li><a href="{{ route('institutes.centers') }}"><i class="fa fa-building"></i> @lang('site.getContent',['ar'=>'المعاهد والمراكز','en'=>'Institutes & Centers'])</a></li>
                    @foreach ($pages as $page)
                        <li class="@if($page->hasChild()) dropdown @endif">
                            <a href="@if($page->hasChild()) javascript:void(0) @else {{$page->getLink()}} @endif" class="@if($page->hasChild()) dropdown-toggle @endif" @if($page->hasChild()) data-toggle="dropdown" @endif>
                                @lang('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn]) @if($page->hasChild()) <span class="caret"></span> @endif
                            </a>
                            @if($page->hasChild())
                                <ul class="dropdown-menu zr-dropdown">
                                    @foreach($page->children as $children)
                                        <li><a href="{{$children->getLink()}}">@lang('site.getContent',['ar'=>$children->title,'en'=>$children->titleEn])</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    <li><a href="{{ url('news') }}"><i class="fa fa-newspaper-o"></i> @lang('site.news')</a></li>
                    <li><a href="{{ route('student.portal') }}" class="zr-nav-portal"><i class="fa fa-graduation-cap"></i> @lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'Student Portal'])</a></li>
                    <li><a href="{{ route('elearning') }}" class="zr-nav-e-learning"><i class="fa fa-laptop"></i> @lang('site.getContent',['ar'=>'التعلم الإلكتروني','en'=>'E-Learning'])</a></li>
                    <li><a href="{{ url('contactUs') }}"><i class="fa fa-phone"></i> @lang('site.contactUs')</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
