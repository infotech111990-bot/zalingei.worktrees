@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = 'students';
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li><a href="{{ mtGetRoute('index','mtCPanel.'.$page) }}">@lang('admin.'.$page)</a></li>
		<li class="active">@lang('admin.results')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
@endsection

@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>{{ $student->name_ar }} - @lang('admin.results')</strong>
				</span>

				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
			</div>

			<div class="panel-body">

                @if(session()->has('added'))
                    <div class="alert alert-success">تمت إضافة النتيجة بنجاح!</div>
                @endif
                @if(session()->has('deleted'))
                    <div class="alert alert-success">تم حذف النتيجة بنجاح!</div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <h4><strong>@lang('admin.addNewItem')</strong></h4>
                        <form action="{{ route('mtCPanel.students.addResult', $student->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>@lang('admin.subject_name')</label>
                                <input type="text" name="subject_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>@lang('admin.marks')</label>
                                <input type="number" step="0.01" name="marks" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>@lang('admin.grade')</label>
                                <select name="grade" class="form-control pointer">
                                    <option value="">—</option>
                                    <option value="A+">A+</option>
                                    <option value="A">A</option>
                                    <option value="B+">B+</option>
                                    <option value="B">B</option>
                                    <option value="C+">C+</option>
                                    <option value="C">C</option>
                                    <option value="D+">D+</option>
                                    <option value="D">D</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('admin.semester')</label>
                                <input type="text" name="semester" class="form-control" placeholder="الفصل الأول 2024">
                            </div>
                            <button type="submit" class="btn btn-3d btn-teal btn-block">@lang('admin.add')</button>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <h4><strong>@lang('admin.results')</strong></h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('admin.subject_name')</th>
                                        <th>@lang('admin.marks')</th>
                                        <th>@lang('admin.grade')</th>
                                        <th>@lang('admin.semester')</th>
                                        <th>@lang('admin.control')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($results as $i => $r)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $r->subject_name }}</td>
                                            <td>{{ $r->marks }}</td>
                                            <td>{{ $r->grade }}</td>
                                            <td>{{ $r->semester }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('mtCPanel.students.deleteResult', $r->id) }}" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه النتيجة؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-red btn-xs btn-3d btn-reveal"><i class="fa fa-times white"></i> <span>@lang('admin.delete')</span></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">لا توجد نتائج مسجلة لهذا الطالب.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <a href="{{ mtGetRoute('index','mtCPanel.'.$page) }}" class="btn btn-primary btn-3d"><i class="fa fa-arrow-right white"></i> <span>العودة للقائمة</span> </a>
                        <a href="{{ mtGetRoute('show','mtCPanel.'.$page, $student->id) }}" class="btn btn-aqua btn-3d"><i class="fa fa-eye white"></i> <span>@lang('admin.show')</span> </a>
                    </div>
                </div>

			</div>
		</div>
    </div>
@stop
