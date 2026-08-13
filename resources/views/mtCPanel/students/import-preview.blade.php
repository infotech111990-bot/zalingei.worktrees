@extends('mtCPanel.layouts.master')
@section('header-title') معاينة استيراد بيانات الطلاب @endsection
@section('content')
<div class="panel panel-default"><div class="panel-heading"><strong>نتيجة فحص الملف</strong></div><div class="panel-body">
@if(!empty($errors))<div class="alert alert-danger"><strong>تم العثور على أخطاء:</strong><ul>@foreach($errors as $error)<li>{{ $error }}</li>@endforeach</ul><p>لن يتم حفظ أي سجل حتى يتم تصحيح الأخطاء.</p></div>@else
<div class="alert alert-success">تم التحقق من {{ count($rows) }} سجل.</div>
<form method="POST" action="{{ route('mtCPanel.students.import.store') }}">@csrf<input type="hidden" name="token" value="{{ $token }}"><button class="btn btn-success" type="submit">تأكيد وحفظ البيانات</button></form>
@endif
<table class="table table-bordered"><thead><tr><th>#</th><th>رقم الطالب</th><th>الاسم</th><th>الكلية</th><th>القسم</th><th>العام</th><th>المستوى</th></tr></thead><tbody>@foreach($rows as $i => $row)<tr><td>{{ $i+1 }}</td><td>{{ $row['student_number'] ?? '' }}</td><td>{{ $row['name_ar'] ?? '' }}</td><td>{{ $row['college_id'] ?? '' }}</td><td>{{ $row['department_id'] ?? '' }}</td><td>{{ $row['academic_year'] ?? '' }}</td><td>{{ $row['level'] ?? '' }}</td></tr>@endforeach</tbody></table>
</div></div>
@stop