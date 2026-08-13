@extends('mtCPanel.layouts.master')
@section('header-title') استيراد بيانات الطلاب @endsection
@section('content')
<div class="panel panel-default"><div class="panel-heading"><strong>رفع Excel / CSV</strong></div><div class="panel-body">
@if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<p><strong>الحقول المطلوبة:</strong> student_number, name_ar, college, department</p>
<p><strong>اختياري:</strong> name_en, national_id, email, phone, academic_year, level</p>
<p><strong>مهم:</strong> سيتم فحص الملف أولاً، ولن يتم حفظ أي طالب قبل اجتياز التحقق.</p>
<form method="POST" action="{{ route('mtCPanel.students.import.preview') }}" enctype="multipart/form-data">@csrf
<div class="form-group"><label>ملف Excel / CSV</label><input class="form-control" type="file" name="file" accept=".xlsx,.csv,.txt" required></div>
<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> فحص ومعاينة</button>
<a class="btn btn-default" href="{{ route('mtCPanel.students.index') }}">رجوع</a>
</form>
</div></div>
@stop