@extends('mtCPanel.layouts.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Page Attachments</h3>
			<div id="attachmentTableContainer"></div>
		</div>
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
			$('#attachmentTableContainer').jtable({
				title: 'page Attachments',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id DESC',
				useBootstrap: true,
				actions: {
					 listAction: 'attachments/list', 
					 createAction: 'attachments/add', 
					 updateAction: 'attachments/update', 
					 deleteAction: 'attachments/delete', 
				},
				fields: {
					id: {
                        title: 'الرقم',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					file: {
		                title: 'صورة الخبر',
		                list: true,
		                create: true,
		                edit: true,
						width: '10%',
                        display: function (data) {
							if(data.record.file){
                                return "<div class='bg-success'><label data-toggle='popover' imgURL='"+data.record.file+"'>"+data.record.file+"</label></div>";
                            }else{
                                return "<div class='bg-danger'><label>No Image Found</label></div>";
                            }
                        },
		                input: function (data) {
							if(data.record){
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"><input type="hidden" name="file" value="'+data.record.file+'" /></div>';
							}else{
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"></div>';
							}
		                }
					},
					title: {
						title: 'العنوان ',
						width: '10%'
					},
					url:{
						title: 'asssasa',
						display: function(data){
							if(data.record.file){
								return "{{Config::get('mtcpanel.contentPath')}}/"+data.record.file;
							}
						}
					},
					desc : {
						title: ' وصف',
						edit: true,
						type: 'textarea',
						list: false
					},
					size: {
		                title: ' الحجم',
		                list: false,
		                create: false,
		                edit: false
                    },
					ext: {
						title: ' الامتداد',
						list: false,
						create: false,
						edit: false
                    },
					recordsLoaded: function(event, data) {
						$('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
								$(this).css('cursor','pointer');
								$(this).popover({
									placement : 'auto right ',
									trigger : 'hover',
									html : true,
									content : '<img width="100%" src="{{Config::get("mtcpanel.contentPath")}}/'+$(this).html()+'" class="thumbnail" alt="" />'
								});
						});
					}
					
                },
				formCreated: function (event, data) {
                    $('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.contentPath')}}",
                            'fileExt'     		: '*.jpg;*.gif;*.png;*.pdf',
                        },
                        'swf'               : '{{ asset("/public/assets/uploadify/uploadify.swf") }}',
                        'uploader'  		: '{{ asset("/public/assets/uploadify/uploadify.php") }}',
                        'cancelImg' 		: '{{ asset("/public/assets/uploadify/cancel.png") }}',
                        //'sizeLimit'   		: 20000000,
                        'auto'      		: true,
                        'onSelect'	     : function() {
                            //alert("Selected");
                        },
                        'onError'     : function (event,ID,fileObj,errorObj) {
                            //alert("Error");
                        },
                        'onUploadSuccess'	 : function(file,data,response) {
                            //alert("Success"+data);
                            $("#imgArea").html('<input type="hidden" name="file" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.contentPath')}}/'+file.name+'" width="100" />');
                        } 
                    });					
				}

			});

            //Load person list from server
			$('#attachmentTableContainer').jtable('load');

        });

	</script>
	@stop