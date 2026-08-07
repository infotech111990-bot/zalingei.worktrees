@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = "admins";
        $priv = "admins";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url('/') }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li class="active">@lang('admin.'.$page)</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
@endsection


@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page)</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					@if(auth()->guard('admin')->user()->hasActionPriv($priv,'create'))
						<li><a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-xs btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a></li>
					@endif
				</ul>
				<!-- /right options -->

			</div>

			<div class="panel-body">
				<div class="table-responsive">
					{{ $data->links() }}
					<table class="table table-striped table-bordered table-hover nomargin">
						<thead>
							<tr>
								<th>#</th>
								<th>@lang('admin.name')</th>
								<th>@lang('admin.email')</th>
								<th>@lang('admin.job_title')</th>
								<th>@lang('admin.admins_privs')</th>
								<th>@lang('admin.control')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $d)
								<tr>
									<td>{{ $d->id }}</td>
									<td>{{ $d->name }}</td>
									<td>{{ $d->email }}</td>
									<td>{{ $d->job_title }}</td>
									<td>
										<a href="{{ mtGetRoute('index','mtCPanel.'.$page.'.privs', $d->id) }}" class="btn btn-info btn-xs"> <i class="fa fa-lock" aria-hidden="true"></i> @lang('admin.admins_privs') </a> 
									</td>
									<td width="22%">
										<a href="{{ mtGetRoute('show','mtCPanel.'.$page, $d->id) }}" class="btn btn-aqua btn-xs btn-3d btn-reveal"><i class="fa fa-eye white"></i> <span>عرض</span> </a>
										<a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $d->id) }}" class="btn btn-yellow btn-xs btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>تحرير</span> </a>
										@if(auth()->guard('admin')->user()->hasActionPriv($priv,'delete'))
											<a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $d->id) }}" class="deleteBtn btn btn-red btn-xs btn-3d btn-reveal"><i class="fa fa-times white"></i> <span>حذف</span> </a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
@stop
@section('scripts')
	<script>
		$('.deleteBtn').on('click', function (){
			var route = $(this).data('route');
			Swal.fire({
				title: 'هل أنت متأكد?',
				text: "سوف يتم مسح البيانات!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'نعم، قم بعملية المسح!'
				}).then((result) => {
				if (result.value) {
					$.ajax({
						url: route,
						type: 'DELETE',
						dataType: "JSON",
						data: {
							"_token": "{{ csrf_token() }}"
						},
						success: function(result) {
							window.open('{{ url('/') }}/mtCPanel/{{ $page }}','_self');
						}
					});
				}
			})
		});
	</script>
	@include('mtCPanel.alerts')
@stop