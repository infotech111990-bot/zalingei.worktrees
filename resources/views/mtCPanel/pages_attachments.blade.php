//-------------------------------------------------- Begin Child Table -----------------------------------------
//CHILD TABLE DEFINITION FOR "Pages Level 1"
                attachments: {
                    title: '',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (data) {
                        //Create an image that will be used to open child table
                        var $img = $('<label class="label label-primary" style="cursor:pointer"> المرفقات <i class="fa fa-fw fa-list"></i></label>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#PeopleTableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
										title: '<i class="fa fa-copy"></i> <span dir="rtl">الملفات المرفقة بـ ('+data.record.title+')</span>',
										paging: true,
										pageSize: 15,
										sorting: true,
										defaultSorting: 'id ASC',
										useBootstrap: true,
										actions: {
											listAction: 'pages_attachments_list/'+data.record.id,
											createAction: 'pages_attachments_add/'+data.record.id,
											updateAction: 'pages_attachments_update',
											deleteAction: 'pages_attachments_delete'
										},
										formCreated: function (event, data) {
											data.form.find('textarea').ckeditor();
										},
										fields: {
										level1Title: {
											list: false,
											create: false,
											edit: false,
											width: '5%',
											display: function(){
												return '<span class="label label-success">المستوى الأول</span>';
											}
										},
					id: {
						title: 'م',
						key: true,
						create: false,
						edit: false,
						list: true,
						width: '3%'
					},
					pageID: {
						title: "@lang('site.category')",
						list: false,
						defaultValue: 0,
						options: 'pages_parents_list'
					},
                    
                    title: {
						title: "@lang('site.title')",
						width: '20%'
					},
					titleEn: {
						title: "@lang('site.titleEn')",
						width: '30%'
					},
					desc: {
						title: "@lang('site.subTxt')",
						width: '25%',
						list: false,
					},
					descEn: {
						title: "@lang('site.subTxtEn')",
						list: false,
						width: '25%',
					},
					file: {
		                title: "@lang('site.picture')",
		                list: true,
		                create: true,
		                edit: true,
						width: '35%',
                        display: function (data) {
							if(data.record.file){
                                return "<div class='bg-success'><label data-toggle='popover' imgURL='"+data.record.file+"'>"+data.record.file+"</label></div>";
                            }else{
                                return "<div class='bg-danger'><label>No Files Found</label></div>";
                            }
                        },
		                input: function (data) {
							if(data.record){
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"><input type="hidden" name="picture" value="'+data.record.file+'" /></div>';
							}else{
								return '<div id="FileUpload" name="FileUpload"></div><div id="imgArea"></div>';
							}
		                }
					},
					size: {
						title: "@lang('site.size')",
						list: false,
						edit: false,
						width: '5%'
					}
				},
                recordsLoaded: function(event, data) {
                    $('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
                            $(this).css('cursor','pointer');
                            $(this).popover({
                                placement : 'auto right ',
                                trigger : 'hover',
                                html : true,
                                content : '<img width="100%" src="{{Config::get("mtcpanel.pagesHeadersPath")}}/'+$(this).html()+'" class="thumbnail" alt="" />'
                            });
                    });
                },
                formCreated: function (event, data) {
                    data.form.find('textarea').ckeditor();
					data.form.find('from').addClass("form");
					data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
                    $('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.pagesHeadersPath')}}",
                            'fileExt'     		: '*.jpg;*.gif;*.png',
                        },
                        'swf'               : '{{Request::root()}}/assets/uploadify/uploadify.swf',
                        'uploader'  		: '{{Request::root()}}/assets/uploadify/uploadify.php',
                        'cancelImg' 		: '{{Request::root()}}/assets/uploadify/cancel.png',
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
                            $("#imgArea").html('<input type="hidden" name="headerImage" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.pagesHeadersPath')}}/'+file.name+'" width="100" />');
                        }
                    });
                }				
									}, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
                        //Return image to show on the person row
                        return $img;
                    }
                },
					
//-------------------------------------------------- End Child Table -----------------------------------------					