@extends('mtCPanel.layouts.master')

@section('php')
    @php        
        $page_title = "colleges_staff";
        $parentPage_title = "colleges";
        $childPage = "staff";
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
                                        <th>@lang('admin.name')</th>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.nameEn')</th>
                                        <td>{{ $data->nameEn }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.gender')</th>
                                        <td>{{ $data->gender->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.dateOfBirth')</th>
                                        <td>{{ $data->dateOfBirth }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.dateOfHiring')</th>
                                        <td>{{ $data->dateOfHiring }}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.college')</th>
                                        <td>@if($data->college) {{ $data->college->title }} @endif</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.dept')</th>
                                        <td>@if($data->dept) {{ $data->dept->title }} @endif</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.sp')</th>
                                        <td>{!! $data->sp !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.spEn')</th>
                                        <td>{!! $data->spEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.subSp')</th>
                                        <td>{!! $data->subSp !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.subSpEn')</th>
                                        <td>{!! $data->subSpEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.degree')</th>
                                        <td>@if($data->degree) {!! $data->degree->title !!} @endif</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.currentJob')</th>
                                        <td>{!! $data->currentJob !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.currentJobEn')</th>
                                        <td>{!! $data->currentJobEn !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.phone')</th>
                                        <td>{!! $data->phone !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.mobile')</th>
                                        <td>{!! $data->mobile !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.email')</th>
                                        <td>{!! $data->email !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.city')</th>
                                        <td>{!! $data->city !!}</td>
                                    </tr>
                                    <tr>
                                        <th>@lang('admin.is_prof')</th>
                                        <td>
                                            @if($data->is_prof == 1) 
                                                <span class="label label-success"> <i class="fa fa-eye" aria-hidden="true"></i> نعم </span> 
                                            @else 
                                                <span class="label label-warning"> <i class="fa fa-eye-slash" aria-hidden="true"></i> لا </span> 
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ $data->getPicture() }}" class="img-responsive thumbnail">
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