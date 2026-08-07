//-------------------------------------------------- Begin Child Table -----------------------------------------
//CHILD TABLE DEFINITION FOR "Pages Level 1"
                level1: {
                    title: '',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (data) {
                        //Create an image that will be used to open child table
                        var $img = $('<label class="label label-danger" style="cursor:pointer">المستوى الأول <i class="fa fa-fw fa-list"></i></label>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#PeopleTableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
										title: '<i class="fa fa-copy"></i> <span dir="rtl">الصفحات الفرعية لـ ('+data.record.linkTitle+')</span>',
										paging: true,
										pageSize: 15,
										sorting: true,
										defaultSorting: 'id ASC',
										useBootstrap: true,
										actions: {
											listAction: 'pages_list/'+data.record.id,
											createAction: 'pages_add/'+data.record.id,
											updateAction: 'pages_update',
											deleteAction: 'pages_delete'
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
					parentID: {
						title: "@lang('site.category')",
						list: false,
						defaultValue: 0,
						options: 'pages_parents_list'
					},
                    
                    @include('mtCPanel.pages_level_2'), //include pages level (2)
                    title: {
						title: "@lang('site.title')",
						width: '20%'
					},
					titleEn: {
						title: "@lang('site.titleEn')",
						width: '30%'
					},
					subTxt: {
						title: "@lang('site.subTxt')",
						width: '25%',
						list: false,
					},
					subTxtEn: {
						title: "@lang('site.subTxtEn')",
						list: false,
						width: '25%',
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
					},
					link: {
						title: "@lang('site.link')",
						list: false,
						width: '5%'
					},					
					order: {
						title: "@lang('site.order')",
						width: '5%',
						defaultValue: '1',
					},
					publish: {
						title: "@lang('site.publish')",
						type: 'checkbox',
						values: { '1': 'إظهار', '0': 'إخفاء' },
						defaultValue: '1',
						list: true,
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
                        'swf'               : '{{ asset('assets/mtCPanel/uploadify/uploadify.swf',') }}
                        'uploader'  		: '{{ asset('assets/mtCPanel/uploadify/uploadify.php',') }}
                        'cancelImg' 		: '{{ asset('assets/mtCPanel/uploadify/cancel.png',') }}
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
                            $("#imgArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.pagesHeadersPath')}}/'+file.name+'" width="100" />');
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