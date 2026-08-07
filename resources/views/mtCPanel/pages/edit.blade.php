@extends('mtCPanel.layouts.master')

@section('php')
    @php
		$page = 'pages';
        $folder = 'public/includes/headers';
        $pic_dimensions =  " أبعاد الصورة (العرض:1000px - الطول:300px)";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url('/') }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li><a href="{{ mtGetRoute('index','mtCPanel.'.$page) }}">@lang('admin.'.$page)</a></li>
		<li class="active">@lang('admin.edit')</li>
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
					<strong>@lang('admin.'.$page) - @lang('admin.edit')</strong> <!-- panel title -->
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
				<form action="{{ mtGetRoute('update','mtCPanel.'.$page, $data->id) }}" method="post" enctype="multipart/form-data" data-success="Sent! Thank you!" data-toastr-position="top-right">
					<input name="_method" type="hidden" value="PUT">
					{{ csrf_field() }}
                    <fieldset>
                        <div class="row">
                            <div class="col-md-8">
							<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.parentPage')</label>
                                        <select name="parent_id" class="form-control pointer required">
                                            <option value="0" {{ ($data->parent_id == 0)? 'selected' : '' }}> صفحة رئيسية </option>
                                            @foreach (App\Page::get() as $p)
                                                <option value="{{ $p->id }}" {{ ($data->parent_id == $p->id)? 'selected' : '' }}> {{ $p->title }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>@lang('admin.title')</label>
                                        <input type="text" name="title" value="{{ $data->title }}" class="form-control required {{ $errors->has('title')? 'error' : '' }}">
                                        @if ($errors->has('title'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.titleEn')</label>
                                        <input type="text" name="title_en" value="{{ $data->title_en }}" class="form-control required {{ $errors->has('title_en')? 'error' : '' }}">
                                        @if ($errors->has('title_en'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('title_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.link')</label>
                                        <input type="text" name="link" value="{{ $data->link }}" class="form-control required {{ $errors->has('link')? 'error' : '' }}">
                                        @if ($errors->has('link'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 
								<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.subTxt')</label>
                                        <input type="text" name="sub_txt" value="{{ $data->sub_txt }}" class="form-control required {{ $errors->has('sub_txt')? 'error' : '' }}">
                                        @if ($errors->has('sub_txt'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('sub_txt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

								<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.subTxtEn')</label>
                                        <input type="text" name="sub_txt_en" value="{{ $data->sub_txt_en }}" class="form-control required {{ $errors->has('sub_txt_en')? 'error' : '' }}">
                                        @if ($errors->has('sub_txt_en'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('sub_txt_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.details')</label>
                                        <textarea name="txt" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->txt !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.detailsEn')</label>
                                        <textarea name="txt_en" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->txt_en !!}
                                        </textarea>
                                    </div>
                                </div>

								<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.order')</label>
                                        <input type="text" name="order" value="{{ $data->order }}" class="form-control required {{ $errors->has('order')? 'error' : '' }}">
                                        @if ($errors->has('order'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('order') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>هل تود نشر الصفحة؟</label>
                                        <input type="radio" name="publish" value="1" {{ ($data->publish == 1)? 'checked=""' : '' }}>
                                        <span>نعم</span>
                                        <input type="radio" name="publish" value="0" {{ ($data->publish != 1)? 'checked=""' : '' }}>
                                        <span>لا</span>
                                        @if ($errors->has('order'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('order') }}</strong>
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
			
			Dropzone.options.myDropzone = {
				url: uplaod_url, //----------------- Upload URL --------------------------------
				params: {
					"_token": token,
					"folder": folder
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
							id: id,
							folder: folder,
						},
						success: function(data){
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
	</script>
    <script>
        @if(old('updated'))
            _toastr("تم التعديل بنجاح","top-center","success",false);
        @endif
    </script>
@stop