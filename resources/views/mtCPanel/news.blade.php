@extends('mtCPanel.layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-comment"></i> News Control</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>

    <div class="row">
        <div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#newsTab" aria-controls="newsTab" role="tab" data-toggle="tab"><i class="fa fa-comment"></i>  News</a></li>
            <li role="presentation"><a href="#newsCatsTab" aria-controls="newsCatsTab" role="tab" data-toggle="tab"><i class="fa fa-comments"></i>  News Categories</a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="newsTab">
                <h3 class="page-header"><i class="fa fa-comment"></i> News</h3>
                <p><div id="newsTableContainer"></div></p>
            </div>
            <div role="tabpanel" class="tab-pane" id="newsCatsTab">
                <h3 class="page-header"><i class="fa fa-comments"></i> News Categories</h3>
                <p><div id="newsCatTableContainer"></div></p>
            </div>
          </div>
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
			$('#newsTableContainer').jtable({

				title: '<i class="fa fa-comment"></i> News',

				paging: true,

				pageSize: 15,

				sorting: true,

				defaultSorting: 'id DESC',

				useBootstrap: true,

				actions: {

					@if(auth()->guard('admin')->user()->hasActionPriv("news","select")) listAction: 'news_list', @endif

					@if(auth()->guard('admin')->user()->hasActionPriv("news","create")) createAction: 'news_add', @endif

					@if(auth()->guard('admin')->user()->hasActionPriv("news","update")) updateAction: 'news_update', @endif

					@if(auth()->guard('admin')->user()->hasActionPriv("news","delete")) deleteAction: 'news_delete', @endif

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

					cat: {

						title: "الصفحة الأب",

						list: true,

						defaultValue: 0,

						options: 'news_cats_options'

					},

					title: {

						title: 'عنوان الخبر',

						width: '40%'

					},

					shortTxt : {

						title: 'نص الخبر',

						edit: true,

						type: 'textarea',

						list: false

					},
					txt : {

						title: 'نص الخبر',

						edit: true,

						type: 'textarea',

						list: false

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

					news_date: {

						title: 'تاريخ الخبر',

						width: '10%',

						type: 'date',

						create: false,

						edit: false

                    }

                },

                recordsLoaded: function(event, data) {
                    $('.jtable-data-row').find('[data-toggle="popover"]').each( function(){
                            $(this).css('cursor','pointer');
                            $(this).popover({
                                placement : 'auto right ',
                                trigger : 'hover',
                                html : true,
                                content : '<img width="100%" src="{{Config::get("mtcpanel.newsPath")}}/'+$(this).html()+'" class="thumbnail" alt="" />'
                            });
                    });
                },

                    //Initialize validation logic when a form is created

                formCreated: function (event, data) {
                    data.form.find('textarea').ckeditor(
                        {
                            uiColor: '#9AB8F3',
                            // 'toolbar' : [
                            //     [ 'Source', '-', 'Bold', 'Italic' ],
                            //     [ 'Image'],
                            //     [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
                            //     [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ]
                            // ]
                        }
                    );
					data.form.find('from').addClass("form");
					data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");

                    $('#FileUpload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo time();?>',
                            'token'     : '<?php echo md5('unique_salt' . time());?>',
                            'folder'    		: "{{Config::get('mtcpanel.newsPath')}}",
                            'fileExt'     		: '*.jpg;*.gif;*.png',
                        },
                        'swf'               : '{{ asset('assets/uploadify/uploadify.swf') }}',
                        'uploader'  		: '{{ asset('assets/uploadify/uploadify.php') }}',
                        'cancelImg' 		: '{{ asset('assets/uploadify/cancel.png') }}',
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
                            $("#imgArea").html('<input type="hidden" name="picture" value="'+file.name+'" /><img src="{{Config::get('mtcpanel.newsPath')}}/'+file.name+'" width="100" />');
                        }
                    });
                }

			});

            





            $('#newsCatTableContainer').jtable({

				title: '<i class="fa fa-comments"></i> News Categories',

				paging: true,

				pageSize: 15,

				sorting: true,

				defaultSorting: 'id ASC',

				useBootstrap: true,

				actions: {

					listAction: 'news_cats_list',

					createAction: 'news_cats_add',

					updateAction: 'news_cats_update',

					deleteAction: 'news_cats_delete'

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

                            // 'toolbar' : [

                            //     [ 'Source', '-', 'Bold', 'Italic' ],

                            //     [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],

                            //     [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ]

                            // ]

                        }

                    );

					data.form.find('from').addClass("form");

					data.form.find('input').addClass("form-control");

					data.form.find('select').addClass("form-control");

                //data.form.validationEngine();



                    //data.form.find('input[name="newsTitle"]').addClass('validate[required]');

                    //data.form.find('input[name="part2"]').addClass('validate[required]');

                    /*data.form.find('input[name="EmailAddress"]').addClass('validate[required,custom[email]]');

                    data.form.find('input[name="Password"]').addClass('validate[required]');

                    data.form.find('input[name="BirthDate"]').addClass('validate[required,custom[date]]');

                    data.form.find('input[name="Education"]').addClass('validate[required]');*/

                    //data.form.validationEngine();

                }

			});



            //Load person list from server

			$('#newsTableContainer').jtable('load');

			$('#newsCatTableContainer').jtable('load');



        });

	</script>

@stop

