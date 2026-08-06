@extends('mtCPanel.layouts.master')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Sites</h3>
			<div id="sitesTableContainer"></div>
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
        $('#sitesTableContainer').jtable({

				title: 'Sites',

				paging: true,

				pageSize: 15,

				sorting: true,

				defaultSorting: 'ID DESC',

				useBootstrap: true,

				actions: {

					listAction: 'jTable/actions/site/list',

					createAction: 'jTable/actions/site/add',

					updateAction: 'jTable/actions/site/update',

					deleteAction: 'jTable/actions/site/delete'

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

                        create: false,

                        edit: false,

                        width: '1%'

					},

					name: {

						title: 'اسم الموقع'

					},

					nameEn: {

						title: 'Site Name'

					},

					url: {

						title: 'Site URL'

					}

				}

			});



            //Load person list from server

			$('#sitesTableContainer').jtable('load');



        });



	</script>
	@stop