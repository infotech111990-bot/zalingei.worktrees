@extends('mtCPanel.layouts.master')

@section('php')
	@php
        $page_title = "admins_privs";
        $parentPage_title = "admins";
        $childPage = "privs";
        $parentPage = "admins";
        $page = $parentPage.".".$childPage;
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li> <a href="{{ mtGetRoute('index','mtCPanel.'.$parentPage) }}">@lang('admin.'.$parentPage_title)</a> </li>
		<li> <a href="{{ mtGetRoute('show','mtCPanel.'.$parentPage,$parent->id) }}">{{ $parent->name }} - {{ $parent->email }}</a> </li>
		<li class="active">@lang('admin.'.$page_title)</li>
@endsection

@section('header-title')
	@lang('admin.'.$page_title)
@endsection

@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page_title)</strong> <a href="{{ mtGetRoute('show','mtCPanel.'.$parentPage,$parent->id) }}">- {{ $parent->name }} - {{ $parent->email }}</a>
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="{{ mtGetRoute('create','mtCPanel.'.$page, $parent->id) }}" class="btn btn-xs btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a></li>
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
								<th>@lang('admin.admins_privs')</th>
								<th>@lang('admin.sub_privs')</th>
								<th>@lang('admin.admin_priv_create')</th>
								<th>@lang('admin.admin_priv_update')</th>
								<th>@lang('admin.admin_priv_delete')</th>
								<th>@lang('admin.control')</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $d)
								<tr>
									<td>{{ $d->id }}</td>
									<td>{{ $d->section }}</td>
									<td>{{ $d->sectionID }}</td>
									<td>
										@if($d->dataCreate == 1) 
											 <i class="fa fa-check text-success" aria-hidden="true"></i> 
										@else 
											 <i class="fa fa-times text-danger" aria-hidden="true"></i> 
										@endif
									</td>
									<td>
										@if($d->dataUpdate == 1) 
											 <i class="fa fa-check text-success" aria-hidden="true"></i> 
										@else 
											 <i class="fa fa-times text-danger" aria-hidden="true"></i> 
										@endif
									</td>
									<td>
										@if($d->dataDelete == 1) 
											 <i class="fa fa-check text-success" aria-hidden="true"></i> 
										@else 
											 <i class="fa fa-times text-danger" aria-hidden="true"></i> 
										@endif
									</td>
									<td width="22%">
										<a href="{{ mtGetRoute('show','mtCPanel.'.$page, $parent->id, $d->id) }}" class="btn btn-aqua btn-xs btn-3d btn-reveal"><i class="fa fa-eye white"></i> <span>عرض</span> </a>
										<a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $parent->id, $d->id) }}" class="btn btn-yellow btn-xs btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>تحرير</span> </a>
										<a 	data-route="{{ route('mtCPanel.'.$page.'.destroy', ['parent_id' => $parent->id, 'id' => $d->id]) }}" 
											data-afterdeleteurl="{{ request()->root() }}/mtCPanel/{{ $parentPage }}/{{ $parent->id }}/{{ $childPage }}" 
											class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal">
											<i class="fa fa-times white"></i> <span>حذف</span>
										</a>
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
			var afterdeleteurl = $(this).data('afterdeleteurl');
			if(confirm('سوف يتم حذف هذا السجل، هل أنت موافق؟')){
				$.ajax({
					url: route,
					type: 'DELETE',
					dataType: "JSON",
					data: {
						"_token": "{{ csrf_token() }}"
					},
					success: function(result) {
						window.open(afterdeleteurl,'_self');
					}
				});
			}
		});
	</script>
	@include('mtCPanel.alerts')
@stop