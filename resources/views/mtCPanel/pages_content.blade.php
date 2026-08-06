//-------------------------------------------------- Begin Child Table -----------------------------------------

//CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
                content: {
                    title: '',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (data) {
                        //Create an image that will be used to open child table
                        var $img = $('<label class="label label-warning" style="cursor:pointer">محتوى الصفحة <i class="fa fa-fw fa-list"></i></label>');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#PeopleTableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
										title: '<span dir="rtl">محتوى صفحة ('+data.record.linkTitle+")</span>",
										paging: true,
										pageSize: 15,
										sorting: true,
										defaultSorting: 'contentID ASC',
										useBootstrap: true,
										actions: {
											listAction: 'pages_content_list/'+data.record.ID,
											createAction: 'pages_content_add',
											updateAction: 'pages_content_update',
											deleteAction: 'pages_content_delete'
										},
										formCreated: function (event, data) {
                                            data.form.find('textarea').ckeditor(
                                                {
                                                    uiColor: '#9AB8F3'
                                                }
                                            );
										},

										fields: {
										emptyFeild: {
                                            width: '1%',
                                            list: true,
                                            edit: false,
                                            create: false,
                                            display: function(){
                                                return '<img src="{{Request::root()}}/assets/jtable/images/rules-16am8kv.png" width="32" height="32" />'
                                            }
                                        },
                        contentID: {
                            key: true,
                            width: '3%',
                            create: true,
                            edit:true,
                            list:true,
                            type: 'hidden',
                            title: data.record.ID,
                            defaultValue: data.record.ID
                        },
                        contentHeader: {
                            title: 'عنوان المحتوى',
                            width: '20%'
                        },
                        contentHeaderEn: {
                            title: 'Content Title',
                            width: '20%'
                        },
                        contentText: {
                            title: 'نص المحتوى',
                            width: '15%',
                            type: 'textarea',
                            display: function(data){
                                if(data.record.contentText > ""){
                                    return "<img src='{{Request::root()}}/assets/jtable/images/icn_alert_success.png' />";
                                }else{
                                    return "<img src='{{Request::root()}}/assets/jtable/images/icn_alert_error.png' />";
                                }
                            }
                        },
                        contentTextEn: {
                            title: 'Content Text',
                            width: '15%',
                            type: 'textarea',
                            display: function(data){
                                if(data.record.contentTextEn > ""){
                                    return "<img src='{{Request::root()}}/assets/jtable/images/icn_alert_success.png' />";
                                }else{
                                    return "<img src='{{Request::root()}}/assets/jtable/images/icn_alert_error.png' />";
                                }
                            }
                        },
                        lastUpdate: {
                            title: 'المحتوى',
                            type: 'hidden',
                            create: true,
                            edit: true,
                            defaultValue: '<?php echo date("Y-m-d"); ?>'
                        }
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