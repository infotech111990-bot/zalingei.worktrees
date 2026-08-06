@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "page_attachments";
        $parentPage_title = "pages";
        $childPage = "attachments";
        $parentPage = "pages";
        $page = $parentPage.".".$childPage;
        $parent = $data->page;
    @endphp
@endsection

@section('breadcrumb')
        <li>
            <i class="fa fa-home"></i>
            <a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
        </li>
        <li> <a href="{{ mtGetRoute('index','mtCPanel.'.$parentPage) }}">@lang('admin.'.$parentPage_title)</a> </li>
        <li> <a href="{{ mtGetRoute('show','mtCPanel.'.$parentPage,$parent->id) }}">{{ $parent->title }}</a> </li>
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
					<strong>@lang('admin.'.$page_title) - @lang('admin.display')</strong> - {{ $parent->title }}
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','update'))
					<li><a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $parent->id, $data->id) }}" class="btn btn-warning btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-edit white"></i> <span>تعديل</span> </a></li>
                    @endif
                    <li>
                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','delete'))
                        <a data-route="{{ route('mtCPanel.'.$page.'.destroy', ['parent_id' => $parent->id, 'id' => $data->id]) }}" 
                                data-afterdeleteurl="{{ request()->root() }}/mtCPanel/{{ $parentPage }}/{{ $parent->id }}/{{ $childPage }}" 
                                class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;">
                                <i class="fa fa-times white"></i> <span>حذف</span>
                        </a>
                    @endif
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
                                <th>@lang('admin.title')</th>
                                <td>{{ $data->title }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.titleEn')</th>
                                <td>{{ $data->title_en }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.details')</th>
                                <td>{{ $data->desc }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.detailsEn')</th>
                                <td>{{ $data->desc_en }}</td>
                            </tr>
                           
                            <tr>
                                <th>@lang('admin.url')</th>
                                <td><a href="{{ $data->getPdf() }}" class="btn btn-info"   target="_blank" style="color:black;" > <i class="fa fa-file-pdf-o" style="color:black;"></i> PDF
								
                                </a></td>
                            </tr>
                        
                            <tr>
                                <th>@lang('admin.publish')</th>
                                <td>
                                    @if($data->publish == 1) 
                                    <span class="label label-success"> <i class="fa fa-eye" aria-hidden="true"></i> منشور </span> 
                                    @else 
                                    <span class="label label-warning"> <i class="fa fa-eye-slash" aria-hidden="true"></i> غير منشور </span> 
                                    @endif
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