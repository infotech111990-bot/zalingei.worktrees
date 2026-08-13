@extends('site.layouts.master')
@section('content')
<div class="container" style="padding:45px 15px">
    <div style="background:linear-gradient(135deg,#123a63,#1d6fa5);color:#fff;border-radius:18px;padding:30px;margin-bottom:25px">
        <div style="font-size:13px;opacity:.8">STUDENT PORTAL / بوابة الطالب</div>
        <h1 style="margin:8px 0">{{ $student->name_ar }}</h1>
        <div>{{ $student->name_en }} · {{ $student->student_number }}</div>
        <div style="margin-top:8px">{{ optional($student->college)->name_en ?: optional($student->college)->name_ar }} @if($student->department) · {{ $student->department->titleEn ?: $student->department->title }} @endif</div>
    </div>
    @php $gpa=$student->calculateGPA(); $credits=$grades->sum(fn($g)=>(int)optional($g->course)->credit_hours); @endphp
    <div class="row" style="margin-bottom:25px">
        <div class="col-sm-4"><div class="panel panel-default" style="border-radius:14px;padding:22px;text-align:center"><div style="font-size:12px;color:#777">CGPA</div><strong style="font-size:36px">{{ number_format($gpa,2) }}</strong><div>out of 4.00</div></div></div>
        <div class="col-sm-4"><div class="panel panel-default" style="border-radius:14px;padding:22px;text-align:center"><div style="font-size:12px;color:#777">CREDITS</div><strong style="font-size:36px">{{ $credits }}</strong><div>credit hours</div></div></div>
        <div class="col-sm-4"><div class="panel panel-default" style="border-radius:14px;padding:22px;text-align:center"><div style="font-size:12px;color:#777">ACADEMIC STATUS</div><strong style="font-size:24px">{{ ucfirst($student->academic_status ?: 'active') }}</strong></div></div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:25px">
        <a class="btn btn-primary" href="{{ route('student.results',['student_number'=>$student->student_number]) }}">Results / النتائج</a>
        <a class="btn btn-default" href="{{ route('student.semesters',['student_number'=>$student->student_number]) }}">Semesters / الفصول</a>
        <a class="btn btn-default" href="{{ route('student.transcript',['student_number'=>$student->student_number]) }}">Academic Transcript / السجل الأكاديمي</a>
    </div>
    <div class="panel panel-default" style="border-radius:14px">
        <div class="panel-heading"><strong>Latest Grades / أحدث الدرجات</strong></div>
        <div class="table-responsive"><table class="table table-hover"><thead><tr><th>Course</th><th>Semester</th><th>Score</th><th>Grade</th><th>Points</th></tr></thead><tbody>
        @forelse($grades->sortByDesc('id')->take(8) as $grade)
        <tr><td>{{ $grade->course->code }} — {{ $grade->course->name ?: $grade->course->name_ar }}</td><td>{{ optional($grade->semester)->name }}</td><td>{{ $grade->total_score ?? '—' }}</td><td><strong>{{ $grade->letter_grade ?? '—' }}</strong></td><td>{{ $grade->grade_points ?? '—' }}</td></tr>
        @empty <tr><td colspan="5" class="text-center">No academic grades have been published yet.</td></tr> @endforelse
        </tbody></table></div>
    </div>
</div>
@endsection
