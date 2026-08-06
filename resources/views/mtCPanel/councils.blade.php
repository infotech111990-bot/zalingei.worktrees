@extends('mtCPanel.layouts.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Councils</h3>
            <div id="councilTableContainer"></div>
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
        $('#councilTableContainer').jtable({
				title: 'Councils',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'id ASC',
				useBootstrap: true,
				actions: {
					listAction: 'jTable/actions/council/list',
					createAction: 'jTable/actions/council/add',
					updateAction: 'jTable/actions/council/update',
					deleteAction: 'jTable/actions/council/delete'
				},
					formCreated: function (event, data) {
					data.form.find('from').addClass("form");
					//data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
					data.form.find('textarea').ckeditor();
				},
				fields: {
					id: {
                       title: 'الرقم',
						key: true,
                        list:true,
                        create: false,
                        edit: false,
                        width: '1%'
                    },
                    year: {
                        title: 'العام',
                        defaultValue: 2017
                    },
                   	name: {
						title: 'الاسم',
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
					title: {
						title: 'المنصب',
                        list: true,
                        create: true,
                        edit: true,
					},
                    titleEn: {
						title: 'title',
                        list:false,
                        create: true,
                        edit: true,
					},
					picture: {
		                title: 'صورة الخبر',
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
					},

                    order: {
                        title: 'الترتيب',
                        list:true,
                    } 
				},
                recordsLoaded: function(event, data) {
                    $('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
                            $(this).css('cursor','pointer');
                            $(this).popover({
                                placement : 'auto right ',
                                trigger : 'hover',
                                html : true,
                                content : '<img width="100%" src="{{Config::get("mtcpanel.councilsPath")}}/'+$(this).html()+'" class="thumbnail" alt="" />'
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

                    $('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.councilsPath')}}",
                            'fileExt'     		: '*.jpg;*.gif;*.png',
                        },
                        'swf'               : '{{ asset("/public/assets/uploadify/uploadify.swf") }}',
                        'uploader'  		: '{{ asset("/public/assets/uploadify/uploadify.php") }}',
                        'cancelImg' 		: '{{ asset("/public/assets/uploadify/cancel.png") }}',
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
                            $("#imgArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.councilsPath')}}/'+file.name+'" width="100" />');
                        }
                    });
                }
                
			});

           //Load person list from server

			$('#councilTableContainer').jtable('load');

        });

	</script>
    @stop