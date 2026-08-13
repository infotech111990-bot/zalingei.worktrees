@extends('site.layouts.master')
@section('content')
<div class="container" style="padding:45px 15px">
<h1>Academic Semesters / الفصول الدراسية</h1><p>Student: <strong>{{ $student->name_ar }}</strong> — {{ $student->student_number }}</p>
<div class="row">
@forelse($semesters as $semester)
<div class="col-md-6"><div class="panel panel-default" style="border-radius:14px;margin-bottom:18px"><div class="panel-body"><h3>{{ $semester->name }}</h3><p>{{ optional($semester->academicYear)->name }}</p><a class="btn btn-primary" href="{{ route('student.results',['student_number'=>$student->student_number]) }}">View Grades / عرض الدرجات</a></div></div></div>
@empty<div class="col-md-12"><div class="alert alert-info">No semesters with published grades yet.</div></div>@endforelse
</div></div>
@endsection
