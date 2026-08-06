@extends('mtCPanel.layouts.master')
 
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Polls</h3>
			<div id="pollsTableContainer"></div>
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

			$('#pollsTableContainer').jtable({
				title: 'Polls',
				paging: true,				
		    	pageSize: 15,				
				sorting: true,				
				defaultSorting: 'id DESC',
				useBootstrap: true,
				actions: {
					listAction: 'jTable/actions/polls/list',
					createAction: 'jTable/actions/polls/add',
					updateAction: 'jTable/actions/polls/update',
					deleteAction: 'jTable/actions/polls/delete',
				},
                fields: {
					id: {
						title: 'الرقم',
						key: true,
						create: false,
						edit: false,
						list: true,
						width: '3%'
					},
                    title: {
						title: 'العنوان',
						width: '20%'
					},
					titleEn: {
						title: 'Poll Title',
						width: '30%'
					},
					startDate: {
						title: 'Start Date',
                        type: 'date',
						width: '30%'
					},
					endDate: {
						title: 'End Date',
                        type: 'date',
						width: '30%'
					},

					activate: {
						title: 'تفعيل الاستطلاع',
						type: 'checkbox',
						values: { '1': 'تفعيل', '0': 'إلغاء التفعيل' },
						defaultValue: '1',
						list: false,
						width: '5%'
					},
					Answers: {
						title: 'Answers',
						width: '5%',
						sorting: true,
						paging: true,
						defaultSorting: 'id ASC',
						edit: false,
						create: false,
						display: function(data){
							var $img = $('<span><i class="fa fa-fw fa-list"></i> Answers</span>');
							$img.click( function(){
								$('#pollsTableContainer').jtable('openChildTable',
								$img.closest('tr'),
								{
									title: 'Answers of ' + data.record.title,
									actions: {
										listAction: 'jTable/actions/pollans/list/'+data.record.id,
									    createAction: 'jTable/actions/pollans/add/'+data.record.id,
										updateAction: 'jTable/actions/pollans/update',
										deleteAction: 'jTable/actions/pollans/delete',
									},
									fields: {
                   					   id: {   
										title: 'الرقم',   
										key: true,  
										create: false, 
										edit: false, 
										list: true,   
										width: '3%',    
                     						},
									   poll_id: {  
										title: "السؤال ",  
										list: true,  
										type: 'hidden',  
										defaultValue: 1,  
										},    
									   title: { 
										title: 'الإجابة', 
										width: '20%'  
										},     
									   titleEn: { 
										title: 'Answer', 
										width: '20%'   
										},      
									   count: {   
										title: 'عدد الأصوات',
										width: '20%',
										list: false,  
										create: false, 
										edit: false
										}	
					}
				}, function (data) {
									data.childTable.jtable('load');
								});
								
							});
							return $img;

				} //end of function
			    } //end of answers
				} //end of fields

			}); //end of Jtable

			//Load person list from server

			$('#pollsTableContainer').jtable('load');
		}); //end of Jquery
	</script>
@stop