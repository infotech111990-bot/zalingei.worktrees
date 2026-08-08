@extends('site.layouts.college')

@section('content')
    <section class="college-hero"><div class="container">
        <div class="eyebrow">@lang('site.getContent',['ar'=>$college->title,'en'=>$college->titleEn])</div>
        <h1>@lang('site.staff')</h1>
        <p>@lang('site.getContent',['ar'=>'تعرف على أعضاء هيئة التدريس وتخصصاتهم ووسائل التواصل الأكاديمية.','en'=>'Meet the academic staff, their specializations, and academic contact details.'])</p>
    </div></section>
    <main class="college-content"><div class="container">
        <section class="academic-card college-section"><div class="staff-grid">
            @forelse($college->staff as $staff)
                <article class="staff-card">
                    <span class="label">{{ $staff->degree ? Lang::get('site.getContent',['ar'=>$staff->degree->title,'en'=>$staff->degree->titleEn]) : Lang::get('site.getContent',['ar'=>'عضو هيئة تدريس','en'=>'Faculty member']) }}</span>
                    <h3><a href="{{ $staff->getUrl() }}">{{ $staff->trans('name','nameEn') }}</a></h3>
                    @if($staff->department)<p><i class="fa fa-sitemap"></i> {{ Lang::get('site.getContent',['ar'=>$staff->department->title,'en'=>$staff->department->titleEn]) }}</p>@endif
                    @if($staff->sp || $staff->spEn)<p><i class="fa fa-book"></i> {{ $staff->trans('sp','spEn') }} @if($staff->subSp || $staff->subSpEn) — {{ $staff->trans('subSp','subSpEn') }} @endif</p>@endif
                    @if($staff->email)<p><a href="mailto:{{ $staff->email }}"><i class="fa fa-envelope"></i> {{ $staff->email }}</a></p>@endif
                </article>
            @empty
                <p class="lead">@lang('site.getContent',['ar'=>'لا توجد بيانات منشورة لهيئة التدريس حالياً.','en'=>'No faculty profiles have been published yet.'])</p>
            @endforelse
        </div></section>
    </div></main>
@stop
