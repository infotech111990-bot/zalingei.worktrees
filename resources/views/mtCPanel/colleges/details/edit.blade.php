@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "colleges_details";
        $parentPage_title = "colleges";
        $childPage = "details";
        $parentPage = "colleges";
		$page = $parentPage.".".$childPage;
		$folder = 'public/includes/colleges/'.$data->college->id.'/details';
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
        <li class="active">{{ $data->title }}</li>
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
							<div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.vision')</label>
                                        <textarea name="vision" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->vision !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.vision') (En)</label>
                                        <textarea name="visionEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->visionEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.mission')</label>
                                        <textarea name="mission" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->mission !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.mission') (En)</label>
                                        <textarea name="missionEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->missionEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.objectives')</label>
                                        <textarea name="objectives" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->objectives !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.objectives') (En)</label>
                                        <textarea name="objectivesEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->objectivesEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.programs')</label>
                                        <textarea name="programs" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->programs !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.programs') (En)</label>
                                        <textarea name="programsEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->programsEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('site.getContent',['ar'=>$parent->type->deanshipWordTitle, 'en'=>$parent->type->deanshipWordTitleEn])</label>
                                        <textarea name="deanWord" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->deanWord !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('site.getContent',['ar'=>$parent->type->deanshipWordTitle, 'en'=>$parent->type->deanshipWordTitleEn]) (En)</label>
                                        <textarea name="deanWordEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->deanWordEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.admission')</label>
                                        <textarea name="admission" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->admission !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.admission') (En)</label>
                                        <textarea name="admissionEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->admissionEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.regulations')</label>
                                        <textarea name="regulations" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->regulations !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.regulations') (En)</label>
                                        <textarea name="regulationsEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->regulationsEn !!}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.calendar')</label>
                                        <textarea name="calendar" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->calendar !!}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 padding-top-15">
                                        <label>@lang('admin.calendar') (En)</label>
                                        <textarea name="calendarEn" class="summernote form-control" data-height="200" data-lang="en-US">
                                            {!! $data->calendarEn !!}
                                        </textarea>
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