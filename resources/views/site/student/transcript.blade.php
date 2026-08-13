@extends('site.layouts.master')
@section('content')
<style>@media print{header,footer,.no-print,.navbar{display:none!important}.transcript{box-shadow:none!important;border:0!important}body{background:#fff!important}.container{width:100%!important}}</style>
<div class="container" style="padding:35px 15px">
<div class="transcript" style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:30px;box-shadow:0 4px 18px rgba(0,0,0,.06)">
<div style="text-align:center;border-bottom:2px solid #123a63;padding-bottom:18px;margin-bottom:20px"><h2>UNIVERSITY OF ZALINGEI</h2><h3>ACADEMIC TRANSCRIPT / السجل الأكاديمي</h3><p>{{ $student->name_ar }} — {{ $student->student_number }}</p><p>{{ optional($student->college)->name_en ?: optional($student->college)->name_ar }} @if($student->department) · {{ $student->department->titleEn ?: $student->department->title }} @endif</p></div>
@php $totalHours=0;$totalPoints=0; @endphp
@forelse($grades->groupBy(fn($g)=>optional($g->semester)->id) as $semesterGrades)
@php $semester=optional($semesterGrades->first())->semester; $hours=$semesterGrades->sum(fn($g)=>(int)optional($g->course)->credit_hours); $points=$semesterGrades->sum(fn($g)=>(float)$g->grade_points*(int)optional($g->course)->credit_hours); $totalHours+=$hours;$totalPoints+=$points; @endphp
<h4 style="margin-top:24px">{{ optional($semester)->name }} — {{ optional(optional($semester)->academicYear)->name }}</h4>
<div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Code</th><th>Course</th><th>Credit Hours</th><th>Score</th><th>Grade</th><th>Points</th></tr></thead><tbody>
@foreach($semesterGrades as $g)<tr><td>{{ $g->course->code }}</td><td>{{ $g->course->name_en }}</td><td>{{ $g->course->credit_hours }}</td><td>{{ $g->total_score ?? '—' }}</td><td>{{ $g->letter_grade ?? '—' }}</td><td>{{ $g->grade_points ?? '—' }}</td></tr>@endforeach
</tbody></table></div>
@empty<div class="alert alert-info">No academic grades have been published yet.</div>@endforelse
<div style="margin-top:25px;padding:18px;background:#f7f9fb"><strong>CGPA: {{ $totalHours ? number_format($totalPoints/$totalHours,2) : '0.00' }} / 4.00</strong> &nbsp; | &nbsp; Total Credit Hours: {{ $totalHours }}</div>
<div class="no-print" style="margin-top:25px"><button class="btn btn-primary" onclick="window.print()">Print Transcript / طباعة السجل</button> <a class="btn btn-default" href="{{ route('student.dashboard',['student_number'=>$student->student_number]) }}">Back</a></div>
</div></div>
@endsection
