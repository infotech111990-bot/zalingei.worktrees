@extends('mtCPanel.layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-file-text-o"></i> Testimonial Control</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
        <div id="PeopleTableContainer"></div>
    </div>
@stop
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: '<i class="fa fa-file-text-o"></i> Pages Control',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id ASC',
				useBootstrap: true,
				actions: {
					listAction: 'testimonial_list',
					@if(auth()->guard('admin')->user()->hasActionPriv('testimonial','create')) createAction: 'testimonial_add', @endif
					updateAction: 'testimonial_update',
					deleteAction: 'testimonial_delete'
				},
					formCreated: function (event, data) {
					data.form.find('from').addClass("form");
					data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
				},
                deleteConfirmation: function(data) {
                    data.deleteConfirmMessage = '<div class="alert alert-warning">The Page "'+ data.record.linkTitle +'" and Its content will be deleted, Are you Sure you want to delete it?</div>';
                },
				fields: {
					id: {
						title: 'م',
						key: true,
						create: false,
						edit: false,
						list: true,
						width: '3%'
					},
                    name: {
						title: "@lang('site.name')",
						width: '20%'
					},
					nameEn: {
						title: "@lang('site.nameEn')",
						width: '30%'
					},
                    title: {
						title: "@lang('site.title')",
						width: '20%'
					},
					titleEn: {
						title: "@lang('site.titleEn')",
						width: '30%'
					},
					txt: {
						title: "@lang('site.txt')",
						width: '25%',
						list: false,
						type: 'textarea',
					},
					txtEn: {
						title: "@lang('site.txtEn')",
						list: false,
						type: 'textarea',
						width: '25%',
					},
					picture: {
		                title: "@lang('site.picture')",
		                list: true,
		                create: true,
		                edit: true,
						width: '35%',
                        display: function (data) {
							if(data.record.picture){
                                return "<div class='bg-success'><label data-toggle='popover' imgURL='"+data.record.picture+"'>"+data.record.picture+"</label></div>";
                            }else{
                                return "<div class='bg-danger'><label>No Image Found</label></div>";
                            }
                        },
		                input: function (data) {
							if(data.record){
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"><input type="hidden" name="picture" value="'+data.record.picture+'" /></div>';
							}else{
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"></div>';
							}
		                }
					}
				},
                recordsLoaded: function(event, data) {
                    $('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
                            $(this).css('cursor','pointer');
                            $(this).popover({
                                placement : 'auto right ',
                                trigger : 'hover',
                                html : true,
                                content : '<img width="100%" src="{{Config::get("mtcpanel.testimonialPath")}}/'+$(this).html()+'" class="thumbnail" alt="" />'
                            });
                    });
                },
                    //Initialize validation logic when a form is created
                formCreated: function (event, data) {
                    // data.form.find('textarea').ckeditor(
                    //     {
                    //         uiColor: '#EEEEEE'
                    //     }
                    // );
					data.form.find('from').addClass("form");
					data.form.find('input[type=text]').addClass("form-control");
					data.form.find('select').addClass("form-control");

                    $('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.testimonialPath')}}",
                            'fileExt'     		: '*.jpg;*.gif;*.png',
                        },
                        'swf'               : '{{Request::root()}}/public/assets/mtCPanel/uploadify/uploadify.swf',
                        'uploader'  		: '{{Request::root()}}/public/assets/mtCPanel/uploadify/uploadify.php',
                        'cancelImg' 		: '{{Request::root()}}/public/assets/mtCPanel/uploadify/cancel.png',
                        'sizeLimit'   		: 10485760,
                        'auto'      		: true,
                        'onSelect'	     : function() {
                            //alert("Selected");
                        },
                        'onError'     : function (event,ID,fileObj,errorObj) {
                            //alert("Error");
                        },
                        'onUploadSuccess'	 : function(file,data,response) {
                            //alert("Success"+data);
                            $("#imgArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.testimonialPath')}}/'+file.name+'" width="100" />');
                        }
                    });
                }
                //data.form.validationEngine();
                                              
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});
	</script>
<script>
    $('[data-toggle="popover"]').popover({
        placement : 'top',
		trigger : 'hover',
        html : true,
        content : '<div class="media"><a href="#" class="pull-left"><img src="../images/avatar-tiny.jpg" class="media-object" alt="Sample Image"></a><div class="media-body"><h4 class="media-heading">Jhon Carter</h4><p>Excellent Bootstrap popover! I really love it.</p></div></div>'
    });
</script>
<script>
//$('.jtable-data-row').css("border", "1px solid");
    //$('#PeopleTableContainer').find("table").css("border", "1px solid");
</script>
@stop