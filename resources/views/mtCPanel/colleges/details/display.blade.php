@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "colleges_details";
        $parentPage_title = "colleges";
        $childPage = "details";
        $parentPage = "colleges";
        $page = $parentPage.".".$childPage;
        $parent = $data->college;
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
        <li class="active">{{ $data->name }}</li>
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
					<li><a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $parent->id, $data->id) }}" class="btn btn-warning btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-edit white"></i> <span>تعديل</span> </a></li>
                    <li><a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $parent->id, $data->id) }}" data-afterdeleteurl="{{ request()->root() }}/mtCPanel/{{ $parentPage }}/{{ $parent->id }}/{{ $childPage }}" class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;"><i class="fa fa-times white"></i> <span>حذف</span> </a></li>
					{{-- <li>
                        <a data-route="{{ route('mtCPanel.'.$page.'.destroy', ['parent_id' => $parent->id, 'id' => $data->id]) }}" 
                                data-afterdeleteurl="{{ request()->root() }}/mtCPanel/{{ $parentPage }}/{{ $parent->id }}/{{ $childPage }}" 
                                class="deleteBtn btn btn-danger btn-xs btn-3d btn-reveal" style="margin-right:10px; margin-left:10px; padding:0px 20px;">
                                <i class="fa fa-times white"></i> <span>حذف</span>
                        </a>
                    </li> --}}
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-striped nomargin">
                                <tbody>
                                    <tr>
                                        <th width="25%">#</th>
                                        <td>{{ $data->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.vision')</th>
                                        <td>{!! $data->vision !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.vision') (En)</th>
                                        <td>{!! $data->visionEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.mission')</th>
                                        <td>{!! $data->mission !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.mission') (En)</th>
                                        <td>{!! $data->missionEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.objectives')</th>
                                        <td>{!! $data->objectives !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.objectives') (En)</th>
                                        <td>{!! $data->objectivesEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('site.getContent',['ar'=>$parent->type->deanshipWordTitle, 'en'=>$parent->type->deanshipWordTitleEn])</th>
                                        <td>{!! $data->deanWord !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('site.getContent',['ar'=>$parent->type->deanshipWordTitle, 'en'=>$parent->type->deanshipWordTitleEn]) (En)</th>
                                        <td>{!! $data->deanWordEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.programs')</th>
                                        <td>{!! $data->programs !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.programs') (En)</th>
                                        <td>{!! $data->programsEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.regulations')</th>
                                        <td>{!! $data->regulations !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.regulations') (En)</th>
                                        <td>{!! $data->regulationsEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.calendar')</th>
                                        <td>{!! $data->calendar !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.calendar') (En)</th>
                                        <td>{!! $data->calendarEn !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
            Swal.fire({
                title: 'هل أنت متأكد?',
                text: "سوف يتم مسح البيانات!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، قم بعملية المسح!'
            }).then((result) => {
                if(result.value){
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
        });
    </script>
	@include('mtCPanel.alerts')
@stop