@extends('mtCPanel.layouts.master')
@section('header-title') استيراد بيانات الطلاب @endsection
@section('content')
<div class="panel panel-default"><div class="panel-heading"><strong>رفع Excel / CSV</strong></div><div class="panel-body">
@if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<p><strong>المطلوب:</strong> student_number, name_ar, college, department</p>
<p><strong>اختياري:</strong> name_en, national_id, email, phone, academic_year, level</p>
<form method="POST" action="/mtCPanel/students" enctype="multipart/form-data">@csrf
<input type="file" name="file" accept=".xlsx,.csv,.txt" required>
<button class="btn btn-primary" type="submit">فحص ومعاينة</button>
</form>
</div></div>
@stop