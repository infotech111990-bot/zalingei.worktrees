@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "admins_privs";
        $parentPage_title = "admins";
        $childPage = "privs";
        $parentPage = "admins";
        $page = $parentPage.".".$childPage;
        $parent = $data->admin;
    @endphp
@endsection

@section('breadcrumb')
        <li>
            <i class="fa fa-home"></i>
            <a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
        </li>
        <li> <a href="{{ mtGetRoute('index','mtCPanel.'.$parentPage) }}">@lang('admin.'.$parentPage_title)</a> </li>
        <li> <a href="{{ mtGetRoute('show','mtCPanel.'.$parentPage,$parent->id) }}">{{ $parent->name }} - {{ $parent->email }}</a> </li>
        <li> <a href="{{ mtGetRoute('index','mtCPanel.'.$page,$parent->id) }}">@lang('admin.'.$page_title)</a> </li>
        <li class="active">@lang('admin.display')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page_title)
@endsection


@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page_title) - @lang('admin.display')</strong> - {{ $parent->name }} - {{ $parent->email }}
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					<li><a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $parent->id, $data->id) }}" class="btn btn-warning btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-edit white"></i> <span>تعديل</span> </a></li>
					<li>
                        <a data-route="{{ route('mtCPanel.'.$page.'.destroy', ['parent_id' => $parent->id, 'id' => $data->id]) }}" 
                                data-afterdeleteurl="{{ request()->root() }}/mtCPanel/{{ $parentPage }}/{{ $parent->id }}/{{ $childPage }}" 
                                class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;">
                                <i class="fa fa-times white"></i> <span>حذف</span>
                        </a>
                    </li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped nomargin">
						<tbody>
                            <tr>
                                <th width="15%">#</th>
                                <td>{{ $data->id }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.admins_privs')</th>
                                <td>{{ $data->section }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.sub_privs')</th>
                                <td>{{ $data->sectionID }}</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if($data->dataCreate == 1) 
                                                        <i class="fa fa-check text-success" aria-hidden="true"></i> 
                                                    @else 
                                                        <i class="fa fa-times text-danger" aria-hidden="true"></i> 
                                                    @endif
                                                    <span>@lang('admin.admin_priv_create')</span>
                                                </td>
                                                <td>
                                                    @if($data->dataUpdate == 1) 
                                                        <i class="fa fa-check text-success" aria-hidden="true"></i> 
                                                    @else 
                                                        <i class="fa fa-times text-danger" aria-hidden="true"></i> 
                                                    @endif
                                                    <span>@lang('admin.admin_priv_update')</span>
                                                </td>
                                                <td>
                                                    @if($data->dataDelete == 1) 
                                                        <i class="fa fa-check text-success" aria-hidden="true"></i> 
                                                    @else 
                                                        <i class="fa fa-times text-danger" aria-hidden="true"></i> 
                                                    @endif
                                                    <span>@lang('admin.admin_priv_delete')</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
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