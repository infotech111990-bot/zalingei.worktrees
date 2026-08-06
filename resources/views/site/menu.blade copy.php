<?php $pages = App\Page::where('parentID',0)->where('publish',1)->orderBy('order','ASC')->get(); ?>
<nav class="main-navigation dd-menu toggle-menu" role="navigation">
    <ul class="sf-menu">
        @foreach($pages as $page)
            <li><a href="@if($page->hasChild()) javascript:void(0) @else {{$page->getLink()}} @endif">{{Lang::get('site.getContent',['ar'=>$page->title,'en'=>$page->titleEn])}}</a>
                @if($page->hasChild())
                    <ul class="dropdown">
                        @foreach($page->children as $children)
                            <li>
                                <a href="{{$children->getLink()}}">
                                    {{Lang::get('site.getContent',['ar'=>$children->title,'en'=>$children->titleEn])}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav> 