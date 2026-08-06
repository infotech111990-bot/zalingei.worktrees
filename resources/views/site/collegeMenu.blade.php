<div class="primary-navigation-wrapper">
    <header class="navbar" id="top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                <ul class="nav navbar-nav">
                    <li><a href="{{Request::root()}}/">{{Lang::get('site.universityHome')}}</a></li>
                    <li><a href="{{Request::root()}}/{{$college->slug}}">@lang('site.collegeHome',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
                    <li class="dropdown">
                        <a href="javascript: return(0);" class="has-child no-link"> @lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn]) </a>
                        <ul class="list-unstyled child-navigation">
                            <li><a href="{{Request::root()}}/{{$college->slug}}/about">@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
                            <li><a href="{{Request::root()}}/{{$college->slug}}/vision">@lang('site.VMO')</a></li>
                            @if($college->type->id == 1 && $college->hasDetails('deanWord'))
                                <li><a href="{{Request::root()}}/{{$college->slug}}/dean">@lang('site.getContent',['ar'=>$college->type->deanshipWordTitle, 'en'=>$college->type->deanshipWordTitleEn])</a></li>
                            @endif
                            @if($college->type->id == 1 && $college->hasDetails('regulations'))
                                <li><a href="{{Request::root()}}/{{$college->slug}}/regulations">@lang('site.regulations')</a></li>
                            @endif
                            @if($college->type->id == 1 && $college->hasDetails('programs'))
                                <li><a href="{{Request::root()}}/{{$college->slug}}/programs">@lang('site.programs')</a></li>
                            @endif
                            @if($college->type->id == 1 && $college->hasDetails('calendar'))
                                <li><a href="{{Request::root()}}/{{$college->slug}}/calendar">@lang('site.calendar')</a></li>
                            @endif
                            @if($college->type->id == 1 && $college->hasDetails('admission'))
                                <li><a href="{{Request::root()}}/{{$college->slug}}/admission">@lang('site.admission')</a></li>
                            @endif
                        </ul>
                    </li>
                    @if($college->departments->count() > 0)
                        <li class="dropdown">
                            <a href="javascript: return(0);" class="has-child no-link">@lang('site.departments')</a>
                            <ul class="list-unstyled child-navigation">
                                @foreach ($college->departments as $dept)
                                    <li><a href="{{$dept->getUrl()}}">@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    @if($college->news->count() > 0)
                        <li><a href="{{Request::root()}}/{{$college->slug}}/news">@lang('site.collegeNews',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
                    @endif
                    @if($college->announcements->count() > 0)
                        <li><a href="{{Request::root()}}/{{$college->slug}}/announcements">@lang('site.collegeAnnouncements',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
                    @endif
                    @if($college->type->display_staff == 1)
                        @if($college->staff->count() > 0)
                            <li><a href="{{Request::root()}}/{{$college->slug}}/staff">@lang('site.staff')</a></li>
                        @endif
                    @endif
                    @if($college->type->display_prof == 1)
                        @if($college->professors->count() > 0)
                            <li><a href="{{Request::root()}}/{{$college->slug}}/prof">@lang('site.professors')</a></li>
                        @endif
                    @endif
                    {{-- @if($college->type->display_students == 1)
                        <li><a href="{{Request::root()}}/{{$college->slug}}/students">@lang('site.students')</a></li>
                    @endif --}}
                    @if($college->extraDetails->count() > 0)
                        <li class="dropdown">
                            <a href="javascript: return(0);" class="has-child no-link">{{Lang::get('site.more')}}</a>
                            <ul class="list-unstyled child-navigation">
                                @foreach ($college->extraDetails as $ed)
                                    <li><a href="{{Request::root()}}/{{$college->slug}}/content/{{$ed->id}}">@lang('site.getContent',['ar'=>$ed->title,'en'=>$ed->titleEn])</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav><!-- /.navbar collapse-->

        </div><!-- /.container -->
    </header><!-- /.navbar -->
</div><!-- /.primary-navigation -->
</div>
<!-- end Header -->
