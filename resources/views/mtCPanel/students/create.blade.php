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
		<li class="active">@lang('admin.add')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
@endsection

@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page) - @lang('admin.add')</strong>
				</span>

				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
			</div>

			<div class="panel-body">
				<form action="{{ mtGetRoute('store','mtCPanel.'.$page) }}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
					{{ csrf_field() }}

                    <fieldset>
                        <div class="row">
							<div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>@lang('admin.student_number')</label>
                                        <input type="text" name="student_number" value="{{ old('student_number') }}" class="form-control required {{ $errors->has('student_number')? 'error' : '' }}">
                                        @if ($errors->has('student_number'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('student_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.name_ar')</label>
                                        <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control required {{ $errors->has('name_ar')? 'error' : '' }}">
                                        @if ($errors->has('name_ar'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('name_ar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.name_en')</label>
                                        <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.email')</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.phone')</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.national_id')</label>
                                        <input type="text" name="national_id" value="{{ old('national_id') }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.college')</label>
                                        <select name="college_id" class="form-control pointer">
                                            <option value="">—</option>
                                            @foreach ($colleges as $college)
                                                <option value="{{ $college->id }}" {{ (old('college_id') == $college->id)? 'selected' : '' }}> {{ $college->name_ar }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.academic_year')</label>
                                        <input type="text" name="academic_year" value="{{ old('academic_year') }}" class="form-control" placeholder="2023 - 2024">
                                    </div>
                                </div>
                            </div>
						</div>
					</fieldset>
					
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
								@lang('admin.add')
							</button>
						</div>
					</div>

				</form>
			</div>
		</div>
    </div>
@stop