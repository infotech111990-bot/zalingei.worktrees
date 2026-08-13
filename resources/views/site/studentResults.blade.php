@extends('site.layouts.master')

@section('content')
<div class="zr-page-hero zr-portal-subhero">
    <div class="container">
        <span class="zr-eyebrow zr-eyebrow-light">@lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'STUDENT PORTAL'])</span>
        <h1>@lang('site.getContent',['ar'=>'نتائج الطلاب','en'=>'Student Results'])</h1>
        <p>@lang('site.getContent',['ar'=>'أدخل رقم الطالب للاستعلام عن نتائجك الدراسية.','en'=>'Enter your student number to check your academic results.'])</p>
    </div>
</div>

<div class="zr-portal-form-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="zr-form-card zr-results-search-card">
                    <div class="zr-form-head">
                        <i class="fa fa-search"></i>
                        <div>
                            <h2>@lang('site.getContent',['ar'=>'الاستعلام عن النتائج','en'=>'Results Lookup'])</h2>
                            <p>@lang('site.getContent',['ar'=>'أدخل رقم الطالب الخاص بك لعرض النتائج','en'=>'Enter your student number to view results'])</p>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="zr-alert zr-alert-success">
                            <i class="fa fa-check-circle"></i>
                            <div><strong>{{ session('success') }}</strong></div>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('student.results') }}" class="zr-form zr-results-form">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                    <label>@lang('site.getContent',['ar'=>'رقم الطالب','en'=>'Student Number']) <span class="zr-required">*</span></label>
                                    <div class="zr-search-box">
                                        <i class="fa fa-id-card"></i>
                                        <input type="text" name="student_number" class="form-control" value="{{ $studentNumber ?? '' }}" required placeholder="@lang('site.getContent',['ar'=>'أدخل رقم الطالب هنا...','en'=>'Enter student number here...'])">
                                    </div>
                                    <p class="help-block">@lang('site.getContent',['ar'=>'مثال: 20231234','en'=>'e.g. 20231234'])</p>
                                </div>
                                <button type="submit" class="zr-btn zr-btn-primary zr-btn-lg zr-btn-block">
                                    <i class="fa fa-search"></i> @lang('site.getContent',['ar'=>'استعلام','en'=>'Search'])
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if(isset($studentNumber) && $studentNumber)
                    @if($student)
                        <div class="zr-results-card">
                            <div class="zr-results-student-head">
                                <div class="zr-student-avatar"><i class="fa fa-user-graduate"></i></div>
                                <div class="zr-student-info">
                                    <h3>{{ $student->name_ar }}</h3>
                                    @if($student->name_en)<p class="zr-student-name-en">{{ $student->name_en }}</p>@endif
                                    <div class="zr-student-meta">
                                        <span><i class="fa fa-id-card"></i> @lang('site.getContent',['ar'=>'رقم الطالب:','en'=>'Student No:']) {{ $student->student_number }}</span>
                                        @if($student->college)
                                            <span><i class="fa fa-university"></i> @lang('site.getContent',['ar'=>'الكلية:','en'=>'College:']) {{ $student->college->name_ar }}</span>
                                        @endif
                                        <span>
                                            <i class="fa fa-sitemap"></i>
                                            @lang('site.getContent',['ar'=>'القسم:','en'=>'Department:'])
                                            {{ optional($student->department)->title ?: optional($student->department)->titleEn ?: __('site.getContent',['ar'=>'غير محدد','en'=>'Not assigned']) }}
                                        </span>
                                        @if($student->academic_year)
                                            <span><i class="fa fa-calendar"></i> @lang('site.getContent',['ar'=>'العام الدراسي:','en'=>'Academic Year:']) {{ $student->academic_year }}</span>
                                        @endif
                                        @if($student->level)
                                            <span><i class="fa fa-layer-group"></i> @lang('site.getContent',['ar'=>'المستوى:','en'=>'Level:']) {{ $student->level }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($academicGrades->count() > 0)
                                <div class="zr-results-body">
                                    <div class="zr-semester-block">
                                        <h4><i class="fa fa-graduation-cap"></i> @lang('site.getContent',['ar'=>'الدرجات الأكاديمية الجديدة','en'=>'New Academic Grades'])</h4>
                                        <div class="table-responsive">
                                            <table class="table zr-results-table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('site.getContent',['ar'=>'المقرر','en'=>'Course'])</th>
                                                        <th>@lang('site.getContent',['ar'=>'الفصل','en'=>'Semester'])</th>
                                                        <th>@lang('site.getContent',['ar'=>'الدرجة','en'=>'Score'])</th>
                                                        <th>@lang('site.getContent',['ar'=>'التقدير','en'=>'Grade'])</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($academicGrades as $i => $grade)
                                                        <tr>
                                                            <td>{{ $i + 1 }}</td>
                                                            <td>{{ optional($grade->course)->code }} — {{ optional($grade->course)->name ?: optional($grade->course)->name_ar }}</td>
                                                            <td>{{ optional($grade->semester)->name ?: '—' }}</td>
                                                            <td>{{ $grade->total_score ?? '—' }}</td>
                                                            <td><strong>{{ $grade->letter_grade ?? '—' }}</strong></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($results->count() > 0)
                                @php
                                    $grouped = $results->groupBy('semester');
                                @endphp
                                <div class="zr-results-body">
                                    <h4 style="margin-top:20px"><i class="fa fa-history"></i> @lang('site.getContent',['ar'=>'النتائج السابقة','en'=>'Legacy Results'])</h4>
                                    @foreach($grouped as $semester => $semResults)
                                        <div class="zr-semester-block">
                                            <h4><i class="fa fa-folder-open"></i> @lang('site.getContent',['ar'=>'الفصل الدراسي:','en'=>'Semester:']) {{ $semester ?: __('site.getContent',['ar'=>'عام','en'=>'General']) }}</h4>
                                            <div class="table-responsive">
                                                <table class="table zr-results-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>@lang('site.getContent',['ar'=>'المادة','en'=>'Subject'])</th>
                                                            <th>@lang('site.getContent',['ar'=>'الدرجة','en'=>'Marks'])</th>
                                                            <th>@lang('site.getContent',['ar'=>'التقدير','en'=>'Grade'])</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($semResults as $i => $r)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>
                                                                <td class="zr-subject-name">{{ $r->subject_name }}</td>
                                                                <td>{{ $r->marks ?? '—' }}</td>
                                                                <td><span class="zr-grade zr-grade-{{ strtolower(preg_replace('/[^A-Za-z0-9]/','', $r->grade)) }}">{{ $r->grade }}</span></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($academicGrades->count() === 0)
                                <div class="zr-empty zr-empty-results">
                                    <i class="fa fa-inbox"></i>
                                    <p>@lang('site.getContent',['ar'=>'لا توجد نتائج مسجلة لهذا الطالب حالياً.','en'=>'No results recorded for this student yet.'])</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="zr-alert zr-alert-danger zr-error-card">
                            <i class="fa fa-user-times"></i>
                            <div>
                                <strong>@lang('site.getContent',['ar'=>'الطالب غير مسجل!','en'=>'Student not found!'])</strong>
                                <p>@lang('site.getContent',['ar'=>'لم يتم العثور على طالب بهذا الرقم. يرجى التأكد من الرقم أو التسجيل أولاً من صفحة تسجيل الطلاب.','en'=>'No student found with this number. Please check the number or register first from the Student Registration page.'])</p>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="zr-form-actions zr-center-actions">
                    <a href="{{ route('student.register') }}" class="zr-btn zr-btn-ghost">
                        <i class="fa fa-user-plus"></i> @lang('site.getContent',['ar'=>'تسجيل طالب جديد','en'=>'Register a New Student'])
                    </a>
                    <a href="{{ route('student.portal') }}" class="zr-btn zr-btn-ghost">
                        <i class="fa fa-arrow-left"></i> @lang('site.getContent',['ar'=>'العودة للبوابة','en'=>'Back to Portal'])
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection