@extends('site.layouts.master')
@section('content')
<!-- Breadcrumb -->
<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">@lang('site.home')</a></li>
        <li class="active">404</li>
    </ol>
</div>
<!-- end Breadcrumb -->

<!-- Page Content -->
<div id="page-content">
    <div class="container">
        <div class="row">
            <h2>عفواً، الصفحة التي تبحث عنها غير موجودة في الموقع</h2>
        </div>
    </div>
</div>
@endsection