@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = 'slides';
		$folder = 'public/includes/slides';
		$pic_dimensions =  " أبعاد الصورة (العرض:1000px - الطول:300px)";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li><a href="{{ mtGetRoute('index','mtCPanel.'.$page) }}">@lang('admin.'.$page)</a></li>
		<li class="active">@lang('admin.add')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
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
					<strong>@lang('admin.'.$page) - @lang('admin.add')</strong> <!-- panel title -->
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
				<form action="{{ mtGetRoute('store','mtCPanel.'.$page) }}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
					{{ csrf_field() }}

                    <fieldset>
                        <div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.template')</label>
										<select name="template" class="form-control pointer required">
											<option value="1">القالب رقم 1</option>
											<option value="2">القالب رقم 2</option>
											<option value="3">القالب رقم 3</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.start_at')</label>
										<input type="date" name="start_at" value="{{ date('Y-m-d') }}" class="form-control required {{ $errors->has('start_at')? 'error' : '' }}">
										@if ($errors->has('start_at'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('start_at') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.end_at')</label>
										<input type="date" name="end_at" value="{{ date('Y-m-d') }}" class="form-control required {{ $errors->has('end_at')? 'error' : '' }}">
										@if ($errors->has('end_at'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('end_at') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.language')</label>
										<select name="lang" class="form-control pointer required">
											<option value="1">العربية</option>
											<option value="2">English</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.headerOne')</label>
										<input type="text" name="headerOne" value="" class="form-control required {{ $errors->has('headerOne')? 'error' : '' }}">
										@if ($errors->has('headerOne'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('headerOne') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.headerTwo')</label>
										<input type="text" name="headerTwo" value="" class="form-control required {{ $errors->has('headerTwo')? 'error' : '' }}">
										@if ($errors->has('headerTwo'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('headerTwo') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.txtOne')</label>
										<input type="text" name="txtOne" value="" class="form-control required {{ $errors->has('txtOne')? 'error' : '' }}">
										@if ($errors->has('txtOne'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('txtOne') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.txtTwo')</label>
										<input type="text" name="txtTwo" value="" class="form-control required {{ $errors->has('txtTwo')? 'error' : '' }}">
										@if ($errors->has('txtTwo'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('txtTwo') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineOne')</label>
										<input type="text" name="lineOne" value="" class="form-control required {{ $errors->has('lineOne')? 'error' : '' }}">
										@if ($errors->has('lineOne'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineOne') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineTwo')</label>
										<input type="text" name="lineTwo" value="" class="form-control required {{ $errors->has('lineTwo')? 'error' : '' }}">
										@if ($errors->has('lineTwo'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineTwo') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineThree')</label>
										<input type="text" name="lineThree" value="" class="form-control required {{ $errors->has('lineThree')? 'error' : '' }}">
										@if ($errors->has('lineThree'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineThree') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineFour')</label>
										<input type="text" name="lineFour" value="" class="form-control required {{ $errors->has('lineFour')? 'error' : '' }}">
										@if ($errors->has('lineFour'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineFour') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineFive')</label>
										<input type="text" name="lineFive" value="" class="form-control required {{ $errors->has('lineFive')? 'error' : '' }}">
										@if ($errors->has('lineFive'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineFive') }}</strong>
											</span>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 col-sm-12">
										<label>@lang('admin.lineSix')</label>
										<input type="text" name="lineSix" value="" class="form-control required {{ $errors->has('lineSix')? 'error' : '' }}">
										@if ($errors->has('lineSix'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('lineSix') }}</strong>
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
											<input type="hidden" id="picture" name="picture">
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