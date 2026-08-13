@extends('site.layouts.master')
@section('content')
<div class="zr-page-hero"><div class="container"><span class="zr-eyebrow zr-eyebrow-light">ACADEMIC EDUCATION / التعليم الأكاديمي</span><h1>University Faculties / كليات الجامعة</h1><p>Explore all faculties and colleges of the University of Zalingei.</p></div></div>
<div class="container" style="padding:45px 15px 60px"><div class="row">
@forelse($colleges as $college)
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a class="zr-college-card" href="{{ $college->getUrl() }}" style="display:block;background:#fff;border:1px solid #dceaf3;border-radius:18px;overflow:hidden;box-shadow:0 10px 28px rgba(12,91,143,.08)"><div style="height:190px;background:#eef6fb"><img src="{{ $college->getPicture() }}" alt="" style="width:100%;height:100%;object-fit:cover"></div><div style="padding:20px"><span style="font-size:11px;color:#0c5b8f;font-weight:800">FACULTY / كلية</span><h3 style="margin:8px 0 0;color:#082c4c;font-weight:800;line-height:1.6">@lang('site.getContent',['ar'=>$college->name_ar,'en'=>$college->name_en])</h3></div></a></div>
@empty
<div class="col-md-12"><div class="alert alert-info">No faculties are currently published.</div></div>
@endforelse
</div></div>
@endsection
