@extends('site.layouts.master')

@section('content')
<style>
    .zr-results-page{background:#f5f7fb;padding:34px 0 70px}
    .zr-results-search{background:#fff;border:1px solid #e7ebf2;border-radius:18px;padding:26px;box-shadow:0 10px 30px rgba(25,42,70,.06);margin-bottom:24px}
    .zr-results-search h2{margin:0 0 6px;font-weight:800;color:#17233c}
    .zr-results-search p{color:#718096;margin-bottom:20px}
    .zr-results-input{position:relative}
    .zr-results-input i{position:absolute;top:15px;left:15px;color:#8a94a6;z-index:2}
    [dir="rtl"] .zr-results-input i{left:auto;right:15px}
    .zr-results-input input{height:48px;padding-left:42px;border-radius:10px;border:1px solid #dce2ea;box-shadow:none}
    [dir="rtl"] .zr-results-input input{padding-left:12px;padding-right:42px}
    .zr-results-btn{height:48px;border:0;border-radius:10px;font-weight:700;padding:0 24px}
    .zr-results-sheet{background:#fff;border:1px solid #e5e9f0;border-radius:20px;overflow:hidden;box-shadow:0 14px 40px rgba(25,42,70,.08)}
    .zr-results-header{padding:28px 30px;background:linear-gradient(135deg,#173b6d,#245b9d);color:#fff;display:flex;align-items:center;justify-content:space-between;gap:20px}
    .zr-results-header h2{margin:0 0 7px;font-weight:800;color:#fff}
    .zr-results-header p{margin:0;opacity:.86}
    .zr-student-badge{width:58px;height:58px;border-radius:50%;background:rgba(255,255,255,.16);display:flex;align-items:center;justify-content:center;font-size:24px;flex:0 0 auto}
    .zr-print-btn{background:#fff;color:#173b6d;border:0;border-radius:9px;padding:10px 16px;font-weight:700;white-space:nowrap}
    .zr-student-profile{padding:24px 30px;border-bottom:1px solid #edf0f5;display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px}
    .zr-profile-item small{display:block;color:#8a94a6;font-size:12px;margin-bottom:5px}
    .zr-profile-item strong{display:block;color:#1e293b;font-size:15px}
    .zr-summary{padding:22px 30px;display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
    .zr-summary-card{border:1px solid #e8ecf2;border-radius:14px;padding:17px;background:#fbfcfe}
    .zr-summary-card small{color:#7b8798;display:block;margin-bottom:7px}
    .zr-summary-card strong{font-size:23px;color:#173b6d}
    .zr-semester{margin:0 30px 24px;border:1px solid #e5e9f0;border-radius:14px;overflow:hidden}
    .zr-semester-title{padding:15px 18px;background:#f7f9fc;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #e5e9f0}
    .zr-semester-title h3{font-size:16px;margin:0;color:#24344d;font-weight:800}
    .zr-semester-title span{font-size:13px;color:#7b8798}
    .zr-results-table{margin:0}
    .zr-results-table thead th{background:#fff;color:#6b778c;border-bottom:1px solid #e5e9f0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;padding:13px 15px}
    .zr-results-table tbody td{padding:14px 15px;vertical-align:middle;border-top:1px solid #f0f2f5;color:#334155}
    .zr-results-table tbody tr:hover{background:#fbfcfe}
    .zr-subject{font-weight:700;color:#1e293b}
    .zr-grade{display:inline-flex;min-width:42px;justify-content:center;padding:5px 9px;border-radius:7px;background:#eef3f9;color:#173b6d;font-weight:800}
    .zr-marks{font-weight:800}
    .zr-empty-results{padding:50px 20px;text-align:center;color:#7b8798}
    .zr-empty-results i{font-size:42px;margin-bottom:12px;opacity:.45}
    .zr-results-error{background:#fff;border:1px solid #f2caca;border-radius:14px;padding:20px;color:#9b2c2c;margin-bottom:20px}
    .zr-results-actions{text-align:center;margin-top:22px}
    @media(max-width:767px){
        .zr-results-page{padding:20px 0 45px}
        .zr-results-search{padding:20px}
        .zr-results-header{padding:22px;align-items:flex-start}
        .zr-print-btn{display:none}
        .zr-student-profile{padding:20px;grid-template-columns:1fr}
        .zr-summary{padding:18px 20px;grid-template-columns:1fr 1fr}
        .zr-semester{margin-left:15px;margin-right:15px}
    }
    @media print{
        .zr-topbar,.zr-navbar,.zr-footer,.zr-page-hero,.zr-results-search,.zr-results-actions{display:none!important}
        .zr-results-page{padding:0;background:#fff}
        .zr-results-sheet{box-shadow:none;border:0}
    }
</style>

<div class="zr-page-hero zr-portal-subhero">
    <div class="container">
        <span class="zr-eyebrow zr-eyebrow-light">@lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'STUDENT PORTAL'])</span>
        <h1>@lang('site.getContent',['ar'=>'النتائج الأكاديمية','en'=>'Academic Results'])</h1>
        <p>@lang('site.getContent',['ar'=>'استعرض نتائجك الأكاديمية بسهولة وأمان باستخدام الرقم الجامعي.','en'=>'View your academic results securely using your student number.'])</p>
    </div>
</div>

<div class="zr-results-page">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="zr-results-search">
                    <h2>@lang('site.getContent',['ar'=>'الاستعلام عن النتائج','en'=>'Results Lookup'])</h2>
                    <p>@lang('site.getContent',['ar'=>'أدخل الرقم الجامعي للحصول على السجل الأكاديمي.','en'=>'Enter your student number to retrieve your academic record.'])</p>
                    <form method="GET" action="{{ route('student.results') }}">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="zr-results-input">
                                    <i class="fa fa-id-card"></i>
                                    <input type="text" name="student_number" class="form-control" value="{{ $studentNumber ?? '' }}" required autocomplete="off" placeholder="@lang('site.getContent',['ar'=>'مثال: 20231234','en'=>'e.g. 20231234'])">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary btn-block zr-results-btn">
                                    <i class="fa fa-search"></i> @lang('site.getContent',['ar'=>'عرض النتائج','en'=>'View Results'])
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if(isset($studentNumber) && $studentNumber)
                    @if($student)
                        <div class="zr-results-sheet">
                            <div class="zr-results-header">
                                <div style="display:flex;align-items:center;gap:15px">
                                    <div class="zr-student-badge"><i class="fa fa-graduation-cap"></i></div>
                                    <div>
                                        <h2>@lang('site.getContent',['ar'=>'السجل الأكاديمي','en'=>'Academic Record'])</h2>
                                        <p>@lang('site.getContent',['ar'=>'جامعة زالنجي','en'=>'University of Zalingei'])</p>
                                    </div>
                                </div>
                                <button type="button" class="zr-print-btn" onclick="window.print()"><i class="fa fa-print"></i> @lang('site.getContent',['ar'=>'طباعة','en'=>'Print'])</button>
                            </div>

                            <div class="zr-student-profile">
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'اسم الطالب','en'=>'Student Name'])</small><strong>{{ $student->name_ar ?: $student->name_en }}</strong></div>
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'الرقم الجامعي','en'=>'Student Number'])</small><strong>{{ $student->student_number }}</strong></div>
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'الاسم بالإنجليزية','en'=>'English Name'])</small><strong>{{ $student->name_en ?: '—' }}</strong></div>
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'الكلية','en'=>'College'])</small><strong>{{ optional($student->college)->name_ar ?: optional($student->college)->name_en ?: '—' }}</strong></div>
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'القسم','en'=>'Department'])</small><strong>{{ optional($student->department)->name_ar ?: optional($student->department)->name_en ?: '—' }}</strong></div>
                                <div class="zr-profile-item"><small>@lang('site.getContent',['ar'=>'العام الدراسي','en'=>'Academic Year'])</small><strong>{{ $student->academic_year ?: '—' }}</strong></div>
                            </div>

                            @if($results->count() > 0)
                                @php
                                    $grouped = $results->groupBy('semester');
                                    $totalMarks = $results->sum(function($r){ return is_numeric($r->marks) ? (float)$r->marks : 0; });
                                    $numericCount = $results->filter(function($r){ return is_numeric($r->marks); })->count();
                                    $average = $numericCount ? round($totalMarks / $numericCount, 2) : null;
                                    $passed = $results->filter(function($r){ return strtoupper(trim((string)$r->grade)) !== 'F'; })->count();
                                @endphp

                                <div class="zr-summary">
                                    <div class="zr-summary-card"><small>@lang('site.getContent',['ar'=>'عدد المقررات','en'=>'Courses'])</small><strong>{{ $results->count() }}</strong></div>
                                    <div class="zr-summary-card"><small>@lang('site.getContent',['ar'=>'متوسط الدرجات','en'=>'Average Marks'])</small><strong>{{ $average !== null ? $average : '—' }}</strong></div>
                                    <div class="zr-summary-card"><small>@lang('site.getContent',['ar'=>'المقررات المجتازة','en'=>'Passed Courses'])</small><strong>{{ $passed }}</strong></div>
                                    <div class="zr-summary-card"><small>@lang('site.getContent',['ar'=>'عدد الفصول','en'=>'Semesters'])</small><strong>{{ $grouped->count() }}</strong></div>
                                </div>

                                @foreach($grouped as $semester => $semResults)
                                    <div class="zr-semester">
                                        <div class="zr-semester-title">
                                            <h3><i class="fa fa-folder-open"></i> @lang('site.getContent',['ar'=>'الفصل الدراسي','en'=>'Semester']) {{ $semester ?: __('site.getContent',['ar'=>'العام','en'=>'General']) }}</h3>
                                            <span>{{ $semResults->count() }} @lang('site.getContent',['ar'=>'مقرر','en'=>'courses'])</span>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table zr-results-table">
                                                <thead><tr><th>#</th><th>@lang('site.getContent',['ar'=>'المقرر الدراسي','en'=>'Course'])</th><th>@lang('site.getContent',['ar'=>'الدرجة','en'=>'Marks'])</th><th>@lang('site.getContent',['ar'=>'التقدير','en'=>'Grade'])</th></tr></thead>
                                                <tbody>
                                                @foreach($semResults as $i => $r)
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td class="zr-subject">{{ $r->subject_name }}</td>
                                                        <td class="zr-marks">{{ $r->marks !== null ? $r->marks : '—' }}</td>
                                                        <td><span class="zr-grade">{{ $r->grade ?: '—' }}</span></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="zr-empty-results"><i class="fa fa-file-text-o"></i><p>@lang('site.getContent',['ar'=>'لا توجد نتائج مسجلة لهذا الطالب حالياً.','en'=>'No academic results are currently recorded for this student.'])</p></div>
                            @endif
                        </div>
                    @else
                        <div class="zr-results-error"><i class="fa fa-exclamation-circle"></i> <strong>@lang('site.getContent',['ar'=>'لم يتم العثور على الطالب.','en'=>'Student not found.'])</strong><p>@lang('site.getContent',['ar'=>'تأكد من الرقم الجامعي وحاول مرة أخرى.','en'=>'Please verify the student number and try again.'])</p></div>
                    @endif
                @endif

                <div class="zr-results-actions">
                    <a href="{{ route('student.register') }}" class="zr-btn zr-btn-ghost"><i class="fa fa-user-plus"></i> @lang('site.getContent',['ar'=>'تسجيل طالب جديد','en'=>'Register a New Student'])</a>
                    <a href="{{ route('student.portal') }}" class="zr-btn zr-btn-ghost"><i class="fa fa-arrow-left"></i> @lang('site.getContent',['ar'=>'العودة للبوابة','en'=>'Back to Portal'])</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection