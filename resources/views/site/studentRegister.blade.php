@extends('site.layouts.master')

@section('content')
@php
    $locale = Config::get('app.locale');
    $lang = $locale == 'ar' ? 1 : 2;
    $latestNews = App\News::where('lang',$lang)->orderBy('created_at','desc')->limit(3)->get();
@endphp

<div class="zr-page-hero zr-portal-subhero">
    <div class="container">
        <span class="zr-eyebrow zr-eyebrow-light">@lang('site.getContent',['ar'=>'بوابة الطالب','en'=>'STUDENT PORTAL'])</span>
        <h1>@lang('site.getContent',['ar'=>'تسجيل الطلاب','en'=>'Student Registration'])</h1>
        <p>@lang('site.getContent',['ar'=>'أدخل بياناتك الأكاديمية بدقة لضمان تسجيل رقمك الصحيح في سجل الطلاب.','en'=>'Enter your academic data accurately to ensure your correct number is registered in the student registry.'])</p>
    </div>
</div>

<div class="zr-portal-form-page">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="zr-form-card">
                    <div class="zr-form-head">
                        <i class="fa fa-graduation-cap"></i>
                        <div>
                            <h2>@lang('site.getContent',['ar'=>'نموذج تسجيل طالب','en'=>'Student Registration Form'])</h2>
                            <p>@lang('site.getContent',['ar'=>'جميع الحقول المميزة بعلامة * إلزامية','en'=>'All fields marked with * are required'])</p>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="zr-alert zr-alert-danger">
                            <i class="fa fa-exclamation-triangle"></i>
                            <div>
                                <strong>@lang('site.getContent',['ar'=>'يرجى تصحيح الأخطاء التالية:','en'=>'Please correct the following errors:'])</strong>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="zr-alert zr-alert-success">
                            <i class="fa fa-check-circle"></i>
                            <div>
                                <strong>{{ session('success') }}</strong>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('student.register.submit') }}" class="zr-form">
                        @csrf

                        <div class="zr-form-section">
                            <h3><i class="fa fa-id-card"></i> @lang('site.getContent',['ar'=>'البيانات الأساسية','en'=>'Basic Information'])</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('student_number') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'رقم الطالب','en'=>'Student Number']) <span class="zr-required">*</span></label>
                                        <input type="text" name="student_number" class="form-control" value="{{ old('student_number') }}" required placeholder="@lang('site.getContent',['ar'=>'مثال: 20231234','en'=>'e.g. 20231234'])">
                                        @error('student_number')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('national_id') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'الرقم الوطني','en'=>'National ID'])</label>
                                        <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" placeholder="@lang('site.getContent',['ar'=>'رقم الهوية الوطنية','en'=>'National ID number'])">
                                        @error('national_id')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('name_ar') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'الاسم (عربي)','en'=>'Name (Arabic)']) <span class="zr-required">*</span></label>
                                        <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required placeholder="@lang('site.getContent',['ar'=>'الاسم رباعي بالعربية','en'=>'Full name in Arabic'])">
                                        @error('name_ar')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('name_en') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'الاسم (إنجليزي)','en'=>'Name (English)'])</label>
                                        <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" placeholder="@lang('site.getContent',['ar'=>'Full name in English','en'=>'Full name in English'])">
                                        @error('name_en')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'البريد الإلكتروني','en'=>'Email'])</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" dir="ltr" placeholder="student@zalingei.edu.sd">
                                        @error('email')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('phone') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'رقم الهاتف','en'=>'Phone'])</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" dir="ltr" placeholder="+249 ...">
                                        @error('phone')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="zr-form-section">
                            <h3><i class="fa fa-university"></i> @lang('site.getContent',['ar'=>'البيانات الأكاديمية','en'=>'Academic Information'])</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('college_id') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'الكلية','en'=>'College'])</label>
                                        <select name="college_id" id="collegeSelect" class="form-control">
                                            <option value="">@lang('site.getContent',['ar'=>'— اختر الكلية —','en'=>'— Select College —'])</option>
                                            @foreach($colleges as $college)
                                                <option value="{{ $college->id }}" @if(old('college_id') == $college->id) selected @endif>
                                                    @lang('site.getContent',['ar'=>$college->name_ar,'en'=>$college->name_en])
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('college_id')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('department_id') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'القسم','en'=>'Department'])</label>
                                        <select name="department_id" id="departmentSelect" class="form-control">
                                            <option value="">@lang('site.getContent',['ar'=>'— اختر القسم —','en'=>'— Select Department —'])</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->id }}" data-college="{{ $dept->college_id }}" @if(old('department_id') == $dept->id) selected @endif>
                                                    @lang('site.getContent',['ar'=>$dept->title,'en'=>$dept->titleEn])
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('academic_year') has-error @enderror">
                                        <label>@lang('site.getContent',['ar'=>'العام الدراسي','en'=>'Academic Year'])</label>
                                        <select name="academic_year" class="form-control">
                                            <option value="">@lang('site.getContent',['ar'=>'— اختر العام الدراسي —','en'=>'— Select Academic Year —'])</option>
                                            @for($y = date('Y'); $y >= date('Y') - 6; $y--)
                                                <option value="{{ $y }} - {{ $y + 1 }}" @if(old('academic_year') == "$y - ".($y+1)) selected @endif>{{ $y }} - {{ $y + 1 }}</option>
                                            @endfor
                                        </select>
                                        @error('academic_year')<span class="help-block">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="zr-form-actions">
                            <button type="submit" class="zr-btn zr-btn-primary zr-btn-lg">
                                <i class="fa fa-check"></i> @lang('site.getContent',['ar'=>'تسجيل الطالب','en'=>'Register Student'])
                            </button>
                            <a href="{{ route('student.portal') }}" class="zr-btn zr-btn-ghost">
                                <i class="fa fa-arrow-left"></i> @lang('site.getContent',['ar'=>'العودة للبوابة','en'=>'Back to Portal'])
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        var $college = $('#collegeSelect');
        var $dept = $('#departmentSelect');

        function filterDepts() {
            var cid = $college.val();
            $dept.find('option').each(function () {
                var collegeAttr = $(this).data('college');
                if (!collegeAttr || !cid || collegeAttr == cid) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            if ($dept.val() && !$dept.find('option:selected').is(':visible')) {
                $dept.val('');
            }
        }

        $college.on('change', filterDepts);
        filterDepts();
    });
</script>
@endsection