<aside>
    <div class="section-content">

<div class="card">
<ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="{{ url('/') }}"><strong>{{Lang::get('site.universityHome')}}</strong></a></li>
    <li class="list-group-item"><a href="{{ url($college->slug) }}"><strong>@lang('site.collegeHome',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</strong></a></li>
    <li class="list-group-item">
        <a href="javascript: return(0);"><strong>@lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</strong></a>
        <ul class="list-links" type="none" style="padding:0px">
            <li><a href="{{ url($college->slug.'/about') }}"> <i class="fa fa-fw"></i>  @lang('site.aboutCollege',['ar'=>$college->type->titleSingle, 'en'=>$college->type->titleSingleEn])</a></li>
            <li><a href="{{ url($college->slug.'/vision') }}"> <i class="fa fa-fw"></i> @lang('site.VMO')</a></li>
            @if($college->details('deanWord'))
                <li><a href="{{ url($college->slug.'/dean') }}"> <i class="fa fa-fw"></i> @lang('site.getContent',['ar'=>$college->type->deanshipWordTitle, 'en'=>$college->type->deanshipWordTitleEn])</a></li>
            @endif
            @if($college->type->id == 1 && $college->details('regulations'))
                <li><a href="{{ url($college->slug.'/regulations') }}"> <i class="fa fa-fw"></i> @lang('site.regulations')</a></li>
            @endif
            @if($college->type->id == 1 && $college->details('programs'))
                <li><a href="{{ url($college->slug.'/programs') }}"> <i class="fa fa-fw"></i> @lang('site.programs')</a></li>
            @endif
            @if($college->type->id == 1 && $college->details('calendar'))
                <li><a href="{{Request::root()}}/{{$college->slug}}/calendar"> <i class="fa fa-fw"></i> @lang('site.calendar')</a></li>
            @endif
            @if($college->type->id == 1 && $college->details('admission'))
                <li><a href="{{Request::root()}}/{{$college->slug}}/admission"><i class="fa fa-fw"></i> @lang('site.admission')</a></li>
            @endif    
        </ul>
    </li>
    @if($college->departments->count() > 0)
        <li class="list-group-item">
            <a href="javascript: return(0);"><strong>@lang('site.departments')</strong></a>
            <ul class="list-links" type="none" style="padding:0px">
                @foreach ($college->departments as $dept)
                    <li> <i class="fa fa-fw"></i> <a href="{{$dept->getUrl()}}">@lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])</a></li>
                @endforeach
            </ul>
        </li>
    @endif
    @if($college->staff->count() > 0)
        <li class="list-group-item"><a href="{{Request::root()}}/{{$college->slug}}/staff"><strong>@lang('site.staff')</strong></a></li>
    @endif
    @if($college->type->id == 1 && $college->professors->count() > 0)
        <li class="list-group-item"><a href="{{Request::root()}}/{{$college->slug}}/prof"><strong>@lang('site.professors')</strong></a></li>
    @endif
    @if($college->extraDetails->count() > 0)
        <li class="list-group-item">
            <a href="javascript: return(0);"><strong>{{Lang::get('site.more')}}</strong></a>
            <ul class="list-links">
                @foreach ($college->extraDetails as $ed)
                    <li> <i class="fa fa-fw"></i> <a href="{{Request::root()}}/{{$college->slug}}/content/{{$ed->id}}">@lang('site.getContent',['ar'=>$ed->title,'en'=>$ed->titleEn])</a></li>
                @endforeach
            </ul>
        </li>
    @endif
</ul>
</div>
    </div>

</aside>