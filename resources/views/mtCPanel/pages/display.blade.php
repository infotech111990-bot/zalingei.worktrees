@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = "pages";
    @endphp
@endsection

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{ url('/') }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li>
			<a href="{{  mtGetRoute('index','mtCPanel.'.$page) }}">@lang('admin.'.$page)</a>
		</li>
		<li class="active">@lang('admin.display')</li>
@endsection

@section('header-title')
	@lang('admin.'.$page)
@endsection


@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.'.$page) - @lang('admin.display')</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','update'))
					<li><a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $data->id) }}" class="btn btn-warning btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-edit white"></i> <span>تعديل</span> </a></li>
                    @endif
                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','delete'))
					<li><a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $data->id) }}" class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-times white"></i> <span>حذف</span> </a></li>
                    @endif
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped nomargin">
						<tbody>
                            <tr>
                                <th width="20%">#</th>
                                <td>{{ $data->id }}</td>
                            </tr>
                            <tr>
								<th>@lang('admin.parentPage')</th>
								<td>@if(isset($data->parent)) {{ $data->parent->title }} @else عنوان رئيسي @endif</td>
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
                                <th>@lang('admin.link')</th>
                                <td>{{ $data->link }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.subTxt')</th>
                                <td>{{ $data->sub_txt }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.subTxtEn')</th>
                                <td>{{ $data->sub_txt_en }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.details')</th>
                                <td>{!! $data->txt !!}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.detailsEn')</th>
                                <td>{!! $data->txt_en !!}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.order')</th>
                                <td>{{ $data->order }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.grid')</th>
                                <td>{{ $data->grid }}</td>
                            </tr>
                            <tr>
                                <th>@lang('admin.status')</th>
                                <td>
                                    @if($data->publish == 1) 
                                    <span class="label label-success"> <i class="fa fa-eye" aria-hidden="true"></i> منشور </span> 
                                    @else 
                                    <span class="label label-warning"> <i class="fa fa-eye-slash" aria-hidden="true"></i> غير منشور </span> 
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>@lang('admin.picture')</th>
                                <td><img src='{{ $data->getPicture() }}' class="thumbnail img-responsive" /></td>
                            </tr>
						</tbody>
						<tfoot>
							<tr>
                                <th>@lang('admin.control')</th>
                                <td>
                                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','update'))
                                    <a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $data->id) }}" class="btn btn-warning btn-xs btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>تعديل</span> </a>
                                    @endif   
                                    @if(!$data->hasChild())
                                    @if(auth()->guard('admin')->user()->hasActionPriv('pages','delete'))
                                        <a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $data->id) }}" class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal"><i class="fa fa-times white"></i> <span>حذف</span> </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>

						</tfoot>
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
            if(confirm('سوف يتم حذف هذا السجل، هل أنت موافق؟')){
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
        });
    </script>
	@include('mtCPanel.alerts')
@stop