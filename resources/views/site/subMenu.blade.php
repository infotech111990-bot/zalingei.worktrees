<?php $parent = $page->parent;
    if(isset($parent->parent)) { $parent = $parent->parent; }
?>
@if($parent > null)
<div class="widget sidebar-widget widget_categories">
        <h3 class="widgettitle">@lang('site.getContent',['ar'=>'القائمة الفرعية', 'en'=> 'Menu'])</h3>
        <ul>
            @foreach($parent->children as $subMenu)
                @if($subMenu->hasChild())
                    <li style="overflow:auto;">
                        <a>
                            @lang('site.getContent',['ar'=>$subMenu->title,'en'=>$subMenu->titleEn])
                        </a>
                            @foreach($subMenu->children as $sm)
                            <li style="overflow:auto; margin-right:25px;"><a href="{{$sm->getLink()}}">@lang('site.getContent',['ar'=>$sm->title,'en'=>$sm->titleEn])</a></libxml_clear_errors>
                            @endforeach
                    </li>
                @else
                    <li style="overflow:auto;"><a href="{{$subMenu->getLink()}}">@lang('site.getContent',['ar'=>$subMenu->title,'en'=>$subMenu->titleEn])</a></libxml_clear_errors>
                @endif
            @endforeach
        </ul>
    </div>
@endif