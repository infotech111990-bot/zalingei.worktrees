@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "colleges_staff";
        $parentPage_title = "colleges";
        $childPage = "staff";
        $parentPage = "colleges";
		$page = $parentPage.".".$childPage;
		$folder = 'public/includes/staff';
		$pic_dimensions =  " أبعاد الصورة (العرض:500px - الطول:500px)";
        $parent = $data->college;
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
        <li class="active">{{ $data->name }}</li>
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
					<strong>@lang('admin.'.$page_title) - @lang('admin.edit')</strong> <!-- panel title -->
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
				<form action="{{ mtGetRoute('update','mtCPanel.'.$page, $parent->id, $data->id) }}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
					<input name="_method" type="hidden" value="PUT">
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
                                        <input type="text" name="name" value="{{ $data->name }}" class="form-control required {{ $errors->has('name')? 'error' : '' }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.nameEn')</label>
										<input type="text" name="nameEn" value="{{ $data->nameEn }}" class="form-control required {{ $errors->has('nameEn')? 'error' : '' }}">
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
											<option value="0" {{ ($data->gender_id == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.gender') </option>
											@foreach (App\Gender::get() as $g)
												<option value="{{ $g->id }}" {{ ($data->gender_id == $g->id)? 'selected' : '' }}> {{ $g->title }} </option>
											@endforeach
										</select>
									</div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.dateOfBirth')</label>
										<input type="date" name="dateOfBirth" value="{{ $data->dateOfBirth }}" class="form-control required {{ $errors->has('dateOfBirth')? 'error' : '' }}">
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
											<option value="0" {{ ($data->staff_degree_id == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.college') </option>
											@foreach (App\StaffDegree::get() as $sd)
												<option value="{{ $sd->id }}" {{ ($data->staff_degree_id == $sd->id)? 'selected' : '' }}> {{ $sd->title }} </option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.dateOfHiring')</label>
										<input type="date" name="dateOfHiring" value="{{ $data->dateOfHiring }}" class="form-control required {{ $errors->has('dateOfHiring')? 'error' : '' }}">
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
										<input type="text" name="currentJob" value="{{ $data->currentJob }}" class="form-control required {{ $errors->has('currentJob')? 'error' : '' }}">
                                        @if ($errors->has('currentJob'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('currentJob') }}</strong>
                                            </span>
                                        @endif
                                    </div>
									<div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.currentJobEn')</label>
										<input type="text" name="currentJobEn" value="{{ $data->currentJobEn }}" class="form-control required {{ $errors->has('currentJobEn')? 'error' : '' }}">
                                        @if ($errors->has('currentJobEn'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('currentJobEn') }}</strong>
                                            </span>
                                        @endif
                                    </div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.college')</label>
										<select name="college_id" class="form-control pointer required">
											<option value="0" {{ ($data->college_id == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.college') </option>
											@foreach (App\College::get() as $col)
												<option value="{{ $col->id }}" {{ ($data->college_id == $col->id)? 'selected' : '' }}> {{ $col->title }} </option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6 col-sm-6 padding-top-15">
										<label>@lang('admin.dept')</label>
										<select name="dept_id" class="form-control pointer required">
											<option value="0" {{ ($data->dept_id == 0)? 'selected' : '' }} disabled="disabled"> @lang('admin.dept') </option>
											@foreach ($data->college->departments as $d)
												<option value="{{ $d->id }}" {{ ($data->dept_id == $d->id)? 'selected' : '' }}> {{ $d->title }} </option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.sp')</label>
										<input type="text" name="sp" value="{{ $data->sp }}" class="form-control required {{ $errors->has('sp')? 'error' : '' }}">
                                        @if ($errors->has('sp'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('sp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.spEn')</label>
										<input type="text" name="spEn" value="{{ $data->spEn }}" class="form-control required {{ $errors->has('spEn')? 'error' : '' }}">
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
										<input type="text" name="subSp" value="{{ $data->subSp }}" class="form-control required {{ $errors->has('subSp')? 'error' : '' }}">
                                        @if ($errors->has('subSp'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('subSp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.subSpEn')</label>
										<input type="text" name="subSpEn" value="{{ $data->subSpEn }}" class="form-control required {{ $errors->has('subSpEn')? 'error' : '' }}">
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
                                        <input type="radio" name="is_prof" value="1" {{ ($data->is_prof == 1)? 'checked=""' : '' }}>
                                        <span>نعم</span>
                                        <input type="radio" name="is_prof" value="0" {{ ($data->is_prof != 1)? 'checked=""' : '' }}>
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
										<input type="text" name="city" value="{{ $data->city }}" class="form-control required {{ $errors->has('city')? 'error' : '' }}">
                                        @if ($errors->has('city'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>@lang('admin.email')</label>
										<input type="text" name="email" value="{{ $data->email }}" class="form-control required {{ $errors->has('email')? 'error' : '' }}">
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
										<input type="text" name="phone" value="{{ $data->phone }}" class="form-control required {{ $errors->has('phone')? 'error' : '' }}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-sm-6 padding-top-15">
                                        <label>@lang('admin.mobile')</label>
										<input type="text" name="mobile" value="{{ $data->mobile }}" class="form-control required {{ $errors->has('mobile')? 'error' : '' }}">
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
                                            <input type="hidden" id="picture" name="picture" value="{{ $data->picture }}">
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
								@lang('admin.edit')
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
			var id = parseInt("{{ $data->id }}");
			var uplaod_url = "{{ route('mtCPanel.dropzone.upload') }}";
			var get_files_url = "{{ route('mtCPanel.'.$page.'.dropzone') }}";
			var remove_url = "{{ route('mtCPanel.'.$page.'.dropzone.remove') }}";
			var folder = "{{ $folder }}";
			var new_file_name = "{{ $data->id }}";

			Dropzone.options.myDropzone = {
				url: uplaod_url, //----------------- Upload URL --------------------------------
				params: {
					"_token": token,
					"folder": folder,
					"new_file_name": new_file_name
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
							id: '{{ $data->id }}'
						},
						success: function(data){
							console.log('success: ' + data);
							myDropzone.options.maxFiles = myDropzone.options.maxFiles + 1;
							$('#picture').val(null);
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

					$.ajax({
						url: get_files_url, //----------------- Get Server Files URL --------------------------------
						type: 'post',
						data: {
							id: id,
							_token: token
							},
						dataType: 'json',
						success: function(response){
							mocks = response;
							$.each(mocks, function(i, mockFile){
								console.log(mockFile.name);
								myDropzone.emit('addedfile', mockFile);
								myDropzone.emit("thumbnail", mockFile, mockFile.path);
								myDropzone.emit('complete', mockFile);
								myDropzone.options.maxFiles = myDropzone.options.maxFiles - 1;
								myDropzone.files.push(mockFile);
							});
						}
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

		function getDepartmentsList(){
        var collegeObject = $('select[name="college_id"]');
        var college_id = collegeObject.val();
        if(college_id > 0) {
              $.ajax({
                  url: '{{ request()->root() }}/mtCPanel/colleges/'+college_id+'/getDepartmentsList',
                  type: "GET",
                  dataType: "json",
                  success:function(data) {
                      $('select[name="dept_id"]').empty();
                      $.each(data, function(key, value) {
                        // console.log(value);
                          $('select[name="dept_id"]').append('<option value="'+ value.id +'">'+ value.title +'</option>');
                      });

                  }
              });
          }else{
              $('select[name="dept_id"]').empty();
              $('select[name="dept_id"]').append('<option value="">اختر الكلية</option>');
          }        
      }

      getDepartmentsList();

      $('select[name="college_id"]').on('change', function() {
        getDepartmentsList();
      });
	</script>
    <script>
        @if(old('updated'))
            _toastr("تم التعديل بنجاح","top-center","success",false);
        @endif
    </script>
@stop