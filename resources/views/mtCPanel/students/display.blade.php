@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = 'students';
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url('/') }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li><a href="{{ mtGetRoute('index','mtCPanel.'.$page) }}">@lang('admin.'.$page)</a></li>
		<li class="active">@lang('admin.show')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
@endsection

@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page) - @lang('admin.show')</strong>
				</span>

				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
			</div>

			<div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th width="200">@lang('admin.student_number')</th>
                                <td>{{ $data->student_number }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.name_ar')</th>
                                <td>{{ $data->name_ar }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.name_en')</th>
                                <td>{{ $data->name_en }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.email')</th>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.phone')</th>
                                <td>{{ $data->phone }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.national_id')</th>
                                <td>{{ $data->national_id }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.college')</th>
                                <td>{{ $data->college ? $data->college->name_ar : '—' }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.academic_year')</th>
                                <td>{{ $data->academic_year }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($results && $results->count() > 0)
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $i => $r)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $r->subject_name }}</td>
                                        <td>{{ $r->marks }}</td>
                                        <td>{{ $r->grade }}</td>
                                        <td>{{ $r->semester }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="row margin-top-20">
                    <div class="col-md-12">
                        <a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $data->id) }}" class="btn btn-yellow btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>@lang('admin.edit')</span> </a>
                        <a href="{{ url('/') }}/mtCPanel/students/{{ $data->id }}/results" class="btn btn-success btn-3d btn-reveal"><i class="fa fa-list white"></i> <span>@lang('admin.results')</span> </a>
                    </div>
                </div>

			</div>
		</div>
    </div>
@stop