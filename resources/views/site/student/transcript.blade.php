@extends('site.layouts.master')
@section('content')
<style>
.transcript-card{background:#fff;border:1px solid #dfe5eb;border-radius:16px;padding:30px;box-shadow:0 8px 30px rgba(18,58,99,.08)}
.transcript-header{border-bottom:3px solid #123a63;padding-bottom:20px;margin-bottom:25px}
.transcript-meta{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin:20px 0}
.transcript-meta div{background:#f7f9fb;border-radius:10px;padding:12px}
.transcript-meta strong{display:block;margin-bottom:4px;color:#123a63}
@media(max-width:767px){.transcript-meta{grid-template-columns:1fr}}
@media print{header,footer,.no-print,.navbar{display:none!important}.transcript-card{box-shadow:none!important;border:0!important}body{background:#fff!important}.container{width:100%!important}}
</style>

<div class="container" style="padding:35px 15px">
    <div class="transcript-card">
        <div class="transcript-header" style="text-align:center">
            <h2>UNIVERSITY OF ZALINGEI</h2>
            <h3>ACADEMIC TRANSCRIPT / السجل الأكاديمي</h3>
            <p>{{ $student->name_en ?: $student->name_ar }} — <strong>{{ $student->student_number }}</strong></p>
        </div>

        <div class="transcript-meta">
            <div><strong>Name / الاسم</strong>{{ $student->name_en ?: $student->name_ar }}</div>
            <div><strong>Student Number / الرقم</strong>{{ $student->student_number }}</div>
            <div><strong>Academic Year / العام الدراسي</strong>{{ $student->academic_year ?: '—' }}</div>
            <div><strong>College / الكلية</strong>{{ optional($student->college)->name_en ?: optional($student->college)->name_ar ?: 'Not assigned / غير محددة' }}</div>
            <div><strong>Department / القسم</strong>{{ optional($student->department)->titleEn ?: optional($student->department)->title ?: 'Not assigned / غير محدد' }}</div>
            <div><strong>CGPA / المعدل</strong>{{ $grades->isNotEmpty() ? number_format($student->calculateGPA(), 2) : '0.00' }}</div>
        </div>

        @if($grades->isNotEmpty())
            @php $totalHours=0; $totalPoints=0; @endphp
            <h3>Academic Grades / الدرجات الأكاديمية</h3>
            @foreach($grades->groupBy(fn($g)=>optional($g->semester)->id) as $semesterGrades)
                @php
                    $semester=optional($semesterGrades->first())->semester;
                    $hours=$semesterGrades->sum(fn($g)=>(int)optional($g->course)->credit_hours);
                    $points=$semesterGrades->sum(fn($g)=>(float)$g->grade_points*(int)optional($g->course)->credit_hours);
                    $totalHours += $hours; $totalPoints += $points;
                @endphp
                <h4 style="margin-top:24px">{{ optional($semester)->name ?: 'Semester' }} — {{ optional(optional($semester)->academicYear)->name ?: '' }}</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead><tr><th>Code</th><th>Course</th><th>Credit Hours</th><th>Score</th><th>Grade</th><th>Points</th></tr></thead>
                        <tbody>
                        @foreach($semesterGrades as $g)
                            <tr>
                                <td>{{ optional($g->course)->code ?: '—' }}</td>
                                <td>{{ optional($g->course)->name_en ?: optional($g->course)->name_ar ?: '—' }}</td>
                                <td>{{ optional($g->course)->credit_hours ?: '—' }}</td>
                                <td>{{ $g->total_score ?? '—' }}</td>
                                <td>{{ $g->letter_grade ?? '—' }}</td>
                                <td>{{ $g->grade_points ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            <div style="margin-top:25px;padding:18px;background:#f7f9fb;border-radius:10px">
                <strong>CGPA: {{ $totalHours ? number_format($totalPoints/$totalHours,2) : '0.00' }} / 4.00</strong>
                &nbsp; | &nbsp; Total Credit Hours: {{ $totalHours }}
            </div>
        @elseif(isset($legacyResults) && $legacyResults->isNotEmpty())
            <div class="alert alert-info">
                <strong>Legacy Results / النتائج القديمة</strong><br>
                No grades are registered in the new academic system yet. Existing legacy results are shown below.
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr><th>Academic Year</th><th>Semester</th><th>Subject</th><th>Marks</th><th>Grade</th></tr></thead>
                    <tbody>
                    @foreach($legacyResults as $result)
                        <tr>
                            <td>{{ $result->academic_year ?: '—' }}</td>
                            <td>{{ $result->semester ?: '—' }}</td>
                            <td>{{ preg_match('/^\?+$/', trim((string)$result->subject_name)) ? 'Legacy subject / مادة قديمة' : $result->subject_name }}</td>
                            <td>{{ $result->marks }}</td>
                            <td><strong>{{ $result->grade }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">No academic grades have been published yet / لم يتم نشر درجات أكاديمية بعد.</div>
        @endif

        <div class="no-print" style="margin-top:25px">
            <button class="btn btn-primary" onclick="window.print()">Print Transcript / طباعة السجل</button>
            <a class="btn btn-default" href="{{ route('student.dashboard', ['student_number'=>$student->student_number]) }}">Back / رجوع</a>
        </div>
    </div>
</div>
@endsection
