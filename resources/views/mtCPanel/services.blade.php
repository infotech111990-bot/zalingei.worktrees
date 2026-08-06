@extends('mtCPanel.layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Services</h3>
			<div id="serviceTableContainer"></div>
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
        $('#serviceTableContainer').jtable({
				title: 'Service',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id DESC',
				useBootstrap: true,
				actions: {
					listAction: 'jTable/actions/service/list',
					createAction: 'jTable/actions/service/add',
					updateAction: 'jTable/actions/service/update',
					deleteAction: 'jTable/actions/service/delete'
				},
				fields: {
					id: {
                        title: 'id',
						key: true,
                        list:true,
                        create: false,
                        edit: false,
                        width: '1%'
					},
					Details: {
						title: 'Details',
						width: '5%',
						sorting: true,
						paging: true,
						defaultSorting: 'id ASC',
						edit: false,
						create: false,
						display: function(data){
							var $img = $('<span><i class="fa fa-fw fa-list"></i> Details</span>');
							$img.click( function(){
								$('#serviceTableContainer').jtable('openChildTable',
								$img.closest('tr'),
								{
									title: 'Details of ' + data.record.name,
									actions: {
										listAction: 'jTable/actions/serviceDetails/list/'+data.record.id,
									    createAction: 'jTable/actions/serviceDetails/add/'+data.record.id,
										updateAction: 'jTable/actions/serviceDetails/update',
										deleteAction: 'jTable/actions/serviceDetails/delete',
									},
									fields: {
										id: {
											title: 'id',
											key: true
										},
										service_id: {
											title: 'service',
                                            create:false,
                                            edit:false,
                                            options:'jTable/actions/service/option'
										},
										title: {
											title: 'العنوان'
										},
                                        titleEn: {
											title: 'Title'
										},
										info: {
											title: 'الوصف',
											type:'textarea',
										},
                                        infoEn: {
											title: 'description',
											type: 'textarea',
										},
									}
								}, function (data) {
									data.childTable.jtable('load');
								});
								
							});
							return $img;
						}
					},
					name: {
						title: 'Name',
                        list:true,
                        create: true,
                        edit: true,
					},
					nameEn: {
						title: 'English Name ',
                        list: false,
                        create: true,
                        edit: true,
					},
					txt: {
						title: 'الوصف',
						type: 'textarea',
                        list: false,
                        create: true,
                        edit: true,
					},
                    txtEn: {
						title: 'description',
						type: 'textarea',
                        list:false,
                        create: true,
                        edit: true,
					},
                    icon: {
						title: 'icon',
                        list:false,
                        create: false,
                        edit: false,
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
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"><input type="hidden" name="picture" value="'+data.record.picture+'" /><img src="{{Config::get('mtcpanel.sevicesHeadersPath')}}/'+data.record.picture+'" width="25%" /></div>';
							}else{
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"></div>';
							}
		                }
					},
                    link: {
						title: 'link',
                        list:false,
                        create: false,
                        edit: false,
					},  
				},
				formCreated: function (event, data) {
                    data.form.find('textarea').ckeditor(
                        {
                            uiColor: '#9AB8F3',
                        }
                    );

					$('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.sevicesHeadersPath')}}",
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
                            $("#imgArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.sevicesHeadersPath')}}/'+file.name+'" width="25%" />');
                        }
                    });
				}
			});
           //Load person list from server
			$('#serviceTableContainer').jtable('load');
        });
	</script>
	@stop