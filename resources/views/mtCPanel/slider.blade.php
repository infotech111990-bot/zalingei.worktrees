@extends('mtCPanel.layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-comment"></i> Slider Control</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
    <div class="row">
        <h3 class="page-header"><i class="fa fa-comment"></i> Slider</h3>
        <p><div id="sliderTableContainer"></div></p>
    </div>
@stop
@section('scripts')
	<?php $timestamp = time();?>
	<link rel="stylesheet" type="text/css" href="{{request()->root()}}/public/uploadifive/uploadifive.css">
	<script src="{{request()->root()}}/public/uploadifive/jquery.uploadifive.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		    //Prepare jTable
			$('#sliderTableContainer').jtable({
				title: '<i class="fa fa-comment"></i> Slider',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id DESC',
				useBootstrap: true,
				actions: {
					@if(auth()->guard('admin')->user()->hasActionPriv("slider","select")) listAction: 'slider_list', @endif
					@if(auth()->guard('admin')->user()->hasActionPriv("slider","create")) createAction: 'slider_add', @endif
					@if(auth()->guard('admin')->user()->hasActionPriv("slider","update")) updateAction: 'slider_update', @endif
					@if(auth()->guard('admin')->user()->hasActionPriv("slider","delete")) deleteAction: 'slider_delete', @endif
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: true
					},
					lang: {
						title: "Language",
						width: '10%',
						list: true,
						defaultValue: 0,
						options: 'languages_options'
					},
					text1: {
						title: 'Text 1',
						width: '40%'
					},
					text2: {
						title: 'Text 2',
						width: '40%'
					},
					text3: {
						title: 'Text 3',
						width: '40%'
					},
					url: {
						title: 'URL',
						width: '40%'
					},
					startDate: {
						title: 'Start Date',
                        type: 'date',
						width: '40%'
					},
					endDate: {
						title: 'End Date',
                        type: 'date',
						width: '40%'
					},
					picture: {
		                title: 'Picture',
		                list: true,
		                create: true,
		                edit: true,
						width: '35%',
                        display: function (data) {
							if(data.record.picture){
                                return "<div class='bg-success'><label class='PicturePopover' data-toggle='popover' imgURL='"+data.record.picture+"'>"+data.record.picture+"</label></div>";
                            }else{
                                return "<div class='bg-danger'><label>No Image Found</label></div>";
                            }
                        },
		                input: function (data) {
							if(data.record){
								return '<div id="PictureUpload" name="PictureUpload"></div><div id="pictureArea"><input type="hidden" name="picture" value="'+data.record.picture+'" /><img src="{{Config::get('mtcpanel.sliderPath')}}/'+data.record.picture+'" style="max-width:300px" /></div>';
							}else{
								return '<div id="PictureUpload" name="PictureUpload"></div><div id="pictureArea"></div>';
							}
		                }
                    }
                },
                recordsLoaded: function(event, data) {
                    $('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
                            $(this).css('cursor','pointer');
                            $(this).popover({
                                placement : 'auto ',
                                trigger : 'hover',
                                html : true,
                                content : '<img width="100%" src="{{ Config::get('mtcpanel.sliderPath') }}/'+$(this).html()+'" class="thumbnail" alt="" />'
                            });
                    });
                },
                    //Initialize validation logic when a form is created
                formCreated: function (event, data) {
                    data.form.find('textarea').ckeditor(
                        {
                            uiColor: '#9AB8F3',
                            'toolbar' : [
                                [ 'Source', '-', 'Bold', 'Italic' ],
                                [ 'Image'],
                                [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
                                [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ]
                            ]
                        }
                    );
					data.form.find('from').addClass("form");
					data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
					$('#PictureUpload').uploadifive({
                        'formData'     : {
								'timestamp' : '<?php echo time();?>',
								'token'     : '<?php echo md5('unique_salt' . time());?>',
								'folder'	: '{{Config::get('mtcpanel.sliderPath')}}/'
							},
							'uploadScript'  : '{{request()->root()}}/public/uploadifive/uploadifive.php',
							'buttonText'    : 'Browse...',
							'fileTypeDesc'  : 'Page Headers',
							'fileTypeExts'  : '*.gif; *.jpg; *.jpeg; *.png',
							'sizeLimit'   	: 10485760,
							'auto'      	: true,
							'onSelect'	    : function() {
								// alert("Selected");
							},
							'onError'     : function (event,ID,fileObj,errorObj) {
								alert("Error");
							},
							'onUploadComplete'	 : function(file,data,response) {
								// alert('The file ' + data + ' uploaded successfully.');
								$("#pictureArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.sliderPath')}}/'+file.name+'" style="max-width:300px" />');
							}
                    });
                }
			});
            
            $('#sliderCatTableContainer').jtable({
				title: '<i class="fa fa-comments"></i> Slider Categories',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id ASC',
				useBootstrap: true,
				actions: {
					listAction: 'slider_cats_list',
					createAction: 'slider_cats_add',
					updateAction: 'slider_cats_update',
					deleteAction: 'slider_cats_delete'
				},
				fields: {
					id: {
						key: true,
						create: false,
						edit: false,
						list: true
					},
					title: {
						title: "اسم التصنيف",
						list: true,
					},
					titleEn: {
						title: "Cat Title",
						list: false,
					},
					txt: {
						title: 'وصف مختصر',
						width: '40%',
                        type: 'textarea'
					},
					txtEn: {
						title: 'Cat Desc',
						width: '40%',
                        type: 'textarea',
                        list: false
					}
                },
                    //Initialize validation logic when a form is created
                formCreated: function (event, data) {
                    data.form.find('textarea').ckeditor(
                        {
                            uiColor: '#9AB8F3',
                            'toolbar' : [
                                [ 'Source', '-', 'Bold', 'Italic' ],
                                [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
                                [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ]
                            ]
                        }
                    );
					data.form.find('from').addClass("form");
					data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
                //data.form.validationEngine();
                    //data.form.find('input[name="sliderTitle"]').addClass('validate[required]');
                    //data.form.find('input[name="part2"]').addClass('validate[required]');
                    /*data.form.find('input[name="EmailAddress"]').addClass('validate[required,custom[email]]');
                    data.form.find('input[name="Password"]').addClass('validate[required]');
                    data.form.find('input[name="BirthDate"]').addClass('validate[required,custom[date]]');
                    data.form.find('input[name="Education"]').addClass('validate[required]');*/
                    //data.form.validationEngine();
                }
			});
            //Load person list from server
			$('#sliderTableContainer').jtable('load');
			$('#sliderCatTableContainer').jtable('load');
        });
	</script>
@stop
