@extends('mtCPanel.layouts.master')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Sites</h3>
			<div id="localeTableContainer"></div>
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
        $('#localeTableContainer').jtable({
				title: 'Locale',
				paging: true,
				pageSize: 15,
				sorting: true,
				defaultSorting: 'var ASC',
				useBootstrap: true,
				actions: {
					listAction: 'jTable/actions/locale/list',
					createAction: 'jTable/actions/locale/add',
					updateAction: 'jTable/actions/locale/update',
					deleteAction: 'jTable/actions/locale/delete'
				},
					formCreated: function (event, data) {
					data.form.find('from').addClass("form");
					//data.form.find('input').addClass("form-control");
					data.form.find('select').addClass("form-control");
					// data.form.find('textarea').ckeditor();
				},
				fields: {
					id: {
                        title: 'الرقم',
						key: true,
                        create: false,
                        edit: false,
                        width: '1%'
					},
					var: {
						title: 'Variable'
					},
					ar: {
                        title: 'Arabic Text',
                        type: 'textarea'
					},
					en: {
                        title: 'English Text',
                        type: 'textarea'
					}
				}
			});
            //Load person list from server
			$('#localeTableContainer').jtable('load');
        });
	</script>
	@stop