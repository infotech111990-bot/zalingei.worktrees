@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page_title = "colleges_staff";
        $parentPage_title = "colleges";
        $childPage = "staff";
        $parentPage = "colleges";
        $page = $parentPage.".".$childPage;
        $folder = 'public/includes/colleges/staff';
        $pic_dimensions =  " أبعاد الصورة (العرض:500px - الطول:500px)";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li> <a href="{{ mtGetRoute('index','mtCPanel.'.$parentPage) }}">@lang('admin.'.$parentPage_title)</a> </li>
		<li> <a href="{{ mtGetRoute('show','mtCPanel.'.$parentPage,$parent->id) }}">{{ $parent->title }}</a> </li>
		<li> <a href="{{ mtGetRoute('index','mtCPanel.'.$page,$parent->id) }}">@lang('admin.'.$page_title)</a> </li>
		<li class="active">@lang('admin.add')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page_title)
@endsection

@section('content')
<style>
.dz-message{
	text-align: center;
	font-size: 28px;
  }
  
.dropzone .dz-preview .dz-details img, .dropzone-previews .dz-preview .dz-details img {
	width: 100% !important;
	height: 100% !important;
	object-fit: cover;
  }
  </style>
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page_title) - @lang('admin.add')</strong> [ {{ $parent->title }} ]
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
				<form action="{{ mtGetRoute('store','mtCPanel.'.$page, $parent->id) }}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
					{{ csrf_field() }}

                    <fieldset>
                        <div class="row">
							<div class="col-md-8">
								
								<div class="form-group">
									<div class="col-md-12 col-sm-12 padding-top-15">
										<h4>البيانات الشخصية</h4>
										<hr>
									</div>
								</div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.name')</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control required {{ $errors->has('name')? 'error' : '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.nameEn')</label>
										<input type="text" name="nameEn" value="{{ old('nameEn') }}" class="form-control required {{ $errors->has('nameEn')? 'error' : '' }}">
                                        @if ($errors->has('nameEn'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('nameEn') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.gender')</label>
										<select name="gender_id" class="form-control pointer required">
											<option value="0" {{ (old('gender_id') == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.gender') </option>
											@foreach (App\Gender::get() as $g)
												<option value="{{ $g->id }}" {{ (old('gender_id == $g->id'))? 'selected' : '' }}> {{ $g->title }} </option>
											@endforeach
										</select>
									</div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.dateOfBirth')</label>
										<input type="date" name="dateOfBirth" value="{{ old('dateOfBirth') }}" class="form-control required {{ $errors->has('dateOfBirth')? 'error' : '' }}">
                                        @if ($errors->has('dateOfBirth'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

                                <div class="form-group">
									<div class="col-md-12 col-sm-12 padding-top-15">
										<h4>بيانات العمل</h4>
										<hr>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.degree')</label>
										<select name="staff_degree_id" class="form-control pointer required">
											<option value="0" {{ (old('staff_degree_id == 0'))? 'selected' : '' }} disabled="disabled"> @lang('admin.college') </option>
											@foreach (App\StaffDegree::get() as $sd)
												<option value="{{ $sd->id }}" {{ (old('staff_degree_id') == $sd->id)? 'selected' : '' }}> {{ $sd->title }} </option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.dateOfHiring')</label>
										<input type="date" name="dateOfHiring" value="{{ old('dateOfHiring') }}" class="form-control required {{ $errors->has('dateOfHiring')? 'error' : '' }}">
                                        @if ($errors->has('dateOfHiring'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('dateOfHiring') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

                                <div class="form-group">
									<div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.currentJob')</label>
										<input type="text" name="currentJob" value="{{ old('currentJob') }}" class="form-control required {{ $errors->has('currentJob')? 'error' : '' }}">
                                        @if ($errors->has('currentJob'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('currentJob') }}</strong>
                                            </span>
                                        @endif
                                    </div>
									<div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.currentJobEn')</label>
										<input type="text" name="currentJobEn" value="{{ old('currentJobEn') }}" class="form-control required {{ $errors->has('currentJobEn')? 'error' : '' }}">
                                        @if ($errors->has('currentJobEn'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('currentJobEn') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

								<div class="form-group">
									{{-- <div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.college')</label>
										<select name="college_id" class="form-control pointer required">
											<option value="0" {{ (old('college_id') == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.college') </option>
											@foreach (App\College::get() as $col)
												<option value="{{ $col->id }}" {{ (old('college_id') == $col->id)? 'selected' : '' }}> {{ $col->title }} </option>
											@endforeach
										</select>
									</div> --}}
									<div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.dept')</label>
										<select name="dept_id" class="form-control pointer required">
											<option value="0" {{ (old('dept_id') == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.dept') </option>
											@foreach ($parent->departments as $dept)
												<option value="{{ $dept->id }}" {{ (old('dept_id') == 0)? 'selected' : '' }} disabled="disabled"> {{ $dept->title }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.sp')</label>
										<input type="text" name="sp" value="{{ old('sp') }}" class="form-control required {{ $errors->has('sp')? 'error' : '' }}">
                                        @if ($errors->has('sp'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('sp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.spEn')</label>
										<input type="text" name="spEn" value="{{ old('spEn') }}" class="form-control required {{ $errors->has('spEn')? 'error' : '' }}">
                                        @if ($errors->has('spEn'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('spEn') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

								<div class="form-group">
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.subSp')</label>
										<input type="text" name="subSp" value="{{ old('subSp') }}" class="form-control required {{ $errors->has('subSp')? 'error' : '' }}">
                                        @if ($errors->has('subSp'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('subSp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.subSpEn')</label>
										<input type="text" name="subSpEn" value="{{ old('subSpEn') }}" class="form-control required {{ $errors->has('subSpEn')? 'error' : '' }}">
                                        @if ($errors->has('subSpEn'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('subSpEn') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

								<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.is_prof')</label>
                                        <input type="radio" name="is_prof" value="1" {{ (old('is_prof') == 1)? 'checked=""' : '' }}>
                                        <span>نعم</span>
                                        <input type="radio" name="is_prof" value="0" {{ (old('is_prof') != 1)? 'checked=""' : '' }}>
                                        <span>لا</span>
                                        @if ($errors->has('is_prof'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('is_prof') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12 padding-top-15">
										<h4>بيانات الإتصال</h4>
										<hr>
									</div>
								</div>

								<div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.city')</label>
										<input type="text" name="city" value="{{ old('city') }}" class="form-control required {{ $errors->has('city')? 'error' : '' }}">
                                        @if ($errors->has('city'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.email')</label>
										<input type="text" name="email" value="{{ old('email') }}" class="form-control required {{ $errors->has('email')? 'error' : '' }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.phone')</label>
										<input type="text" name="phone" value="{{ old('phone') }}" class="form-control required {{ $errors->has('phone')? 'error' : '' }}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.mobile')</label>
										<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control required {{ $errors->has('mobile')? 'error' : '' }}">
                                        @if ($errors->has('mobile'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

							</div>
							<div class="col-md-4">
								<div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>@lang('admin.picture')</label>
                                        <div action="" method="post" class="dropzone" id="my-dropzone">
                                            <input type="hidden" id="picture" name="picture" value="{{ old('picture') }}">
                                            <h4>أفلت الملفات هنا، أو إضغط هنا @if(isset($pic_dimensions))<br> <small>{{ $pic_dimensions }}</small>@endif</h4>
                                            <div class="dz-message" data-dz-message></div>
                                        </div>
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
@section('scripts')
	<script type="text/javascript">
		loadScript(plugin_path + 'dropzone/dropzone.js', function() {

			// Dropzone.autoDiscover = false;

			var token = "{!! csrf_token() !!}";
			var uplaod_url = "{{ route('mtCPanel.dropzone.upload') }}";
			var get_files_url = "{{ route('mtCPanel.'.$page.'.dropzone') }}";
			var remove_url = "{{ route('mtCPanel.'.$page.'.dropzone.remove') }}";
			var folder = "{{ $folder }}";
			var prefix = "{{ date('Y-m-d_H-m-i') }}_";

			
			Dropzone.options.myDropzone = {
				url: uplaod_url, //----------------- Upload URL --------------------------------
				params: {
					"_token": token,
					"folder": folder,
					"prefix": prefix
				},
				paramName: "file", // The name that will be used to transfer the file
				maxFilesize: 10, // MB
				maxFiles: 1,
				dictCancelUploadConfirmation: "Are you sure to cancel upload?",
				dictRemoveFile: "حذف",
				addRemoveLinks: true,
				removedfile: function(file) {
					var name = file.name; 
					
					$.ajax({
						type: 'post',
						url: remove_url, //----------------- Remove URL --------------------------------
						data: {
							_token: token,
							name: name,
							id: 255
						},
						sucess: function(data){
							console.log('success: ' + data);
							myDropzone.options.maxFiles = myDropzone.options.maxFiles + 1;
						}
					});
					var _ref;
						return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
				},
				accept: function(file, done) {
					var re = /(?:\.([^.]+))?$/;
					var ext = re.exec(file.name)[1];
					ext = ext.toUpperCase();
					if ( ext == "JPG" || ext == "JPEG" || ext == "PNG" ||  ext == "GIF" ||  ext == "BMP") 
					{
						done();
					}else { 
						done("Please select only supported picture files."); 
					}
				},
				init: function() {
					myDropzone = this;
					this.on('maxfilesexceeded', function (file) {
						// this.removeAllFiles();
						// this.addFile(file);
					});

					this.on("addedfile", function(file) { fileupload_flag = 1; });
					this.on("complete", function(file) { fileupload_flag = 0; });
					this.on("success", 
						function( file, response ){
							obj = JSON.parse(response);
							$("#picture").val(obj.filename);
						}
					);
				},
			};

		});
	</script>
@stop