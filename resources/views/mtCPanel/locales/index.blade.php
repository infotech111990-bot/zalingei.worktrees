@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = "locales";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
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
					<li><a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-xs btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					{{ $data->links() }}
					<table class="table table-striped table-bordered table-hover nomargin">
						<thead>
							<tr>
								<th>#</th>
								<th>@lang('admin.var')</th>
								<th>@lang('admin.category')</th>
								<th>@lang('admin.ar')</th>
								<th>@lang('admin.en')</th>
								<th>@lang('admin.control')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $d)
								<tr>
									<td>{{ $d->id }}</td>
									<td>{{ $d->var }}</td>
									<td>
										@if($d->section_id == 1) Site @endif
										@if($d->section_id == 2) Admin @endif
									</td>
									<td>{{ $d->ar }}</td>
									<td>{{ $d->en }}</td>
									<td width="22%">
										<a href="{{ mtGetRoute('show','mtCPanel.'.$page, $d->id) }}" class="btn btn-aqua btn-xs btn-3d btn-reveal"><i class="fa fa-eye white"></i> <span>عرض</span> </a>
										<a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $d->id) }}" class="btn btn-yellow btn-xs btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>تحرير</span> </a>
										<a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $d->id) }}" class="deleteBtn btn btn-red btn-xs btn-3d btn-reveal"><i class="fa fa-times white"></i> <span>حذف</span> </a>
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
							window.open('{{ request()->root() }}/mtCPanel/{{ $page }}','_self');
						}
					});
				}
			})
		});
	</script>
	@include('mtCPanel.alerts')
@stop