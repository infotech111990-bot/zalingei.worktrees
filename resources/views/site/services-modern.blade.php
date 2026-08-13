@extends('site.layouts.master')
@section('content')
<div class="zr-page-hero"><div class="container"><span class="zr-eyebrow zr-eyebrow-light">DIGITAL SERVICES / الخدمات الرقمية</span><h1>University Services / خدمات الجامعة</h1><p>Access academic, digital and student services from one place.</p></div></div>
<div class="container" style="padding:45px 15px 70px"><div class="row">
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a href="{{ route('student.portal') }}" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-graduation-cap"></i></span><span><b>Student Portal</b><small>Registration & Results</small></span><i class="fa fa-arrow-left"></i></a></div>
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a href="{{ route('elearning') }}" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-laptop"></i></span><span><b>E-Learning</b><small>Classera</small></span><i class="fa fa-arrow-left"></i></a></div>
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a href="{{ route('faculties') }}" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-university"></i></span><span><b>Faculties</b><small>Academic Colleges</small></span><i class="fa fa-arrow-left"></i></a></div>
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a target="_blank" rel="noopener" href="http://41.67.48.106/ojs" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-book"></i></span><span><b>Scientific Journals</b><small>OJS</small></span><i class="fa fa-arrow-left"></i></a></div>
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a target="_blank" rel="noopener" href="http://41.67.48.106:8090" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-university"></i></span><span><b>Digital Library</b><small>KOHA</small></span><i class="fa fa-arrow-left"></i></a></div>
<div class="col-md-4 col-sm-6" style="margin-bottom:25px"><a target="_blank" rel="noopener" href="http://41.67.48.106:8080/jspui" class="zr-system-card"><span class="zr-system-icon"><i class="fa fa-database"></i></span><span><b>Digital Repository</b><small>DSpace</small></span><i class="fa fa-arrow-left"></i></a></div>
</div></div>
@endsection
