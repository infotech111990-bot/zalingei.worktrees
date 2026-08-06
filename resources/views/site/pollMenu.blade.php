<h4 class="heading-primary">استطلاعات قائمة حالياً</h4>
<?php $polls = App\Poll::where('startDate','<=',date("Y-m-d"))->where('endDate','>=',date("Y-m-d"))->orderByRaw('rand()')->paginate(10); ?>
{{$polls->links()}}
<div class="widget">
    <ul class="nav nav-list mb-xlg">
        @foreach($polls as $poll)
        <li><a href="{{request()->root()}}/polls/{{$poll->id}}">@lang('site.getContent',['ar'=>$poll->title,'en'=>$poll->titleEn])</a></libxml_clear_errors>
            @endforeach
    </ul>
</div>
{{$polls->links()}}

<h4 class="heading-primary">استطلاعات سابقة</h4>
<?php $endPolls = App\Poll::where('startDate','>=',date("Y-m-d"))->orWhere('endDate','<=',date("Y-m-d"))->orderByRaw('rand()')->paginate(10); ?>
{{$endPolls->links()}}
<div class="widget">
    <ul class="nav nav-list mb-xlg">
        @foreach($endPolls as $poll)
        <li><a href="{{request()->root()}}/polls/{{$poll->id}}">@lang('site.getContent',['ar'=>$poll->title,'en'=>$poll->titleEn])</a></libxml_clear_errors>
            @endforeach
    </ul>
</div>
{{$endPolls->links()}}
