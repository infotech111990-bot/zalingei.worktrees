@extends('mtCPanel.layouts.master')

@section('php')
    @php
        $page = "students";
    @endphp
@endsection

@section('breadcrumb')
        <li><i class="fa fa-home"></i><a href="{{ url('/') }}/mtCPanel">@lang('admin.cpanel')</a></li>
        <li class="active">@lang('admin.'.$page)</li>
@endsection

@section('header-title')
    @lang('admin.'.$page)
@endsection

@section('content')
    <div class="row"><div id="panel-1" class="panel panel-default">
        <div class="panel-heading"><span class="title elipsis"><strong>@lang('admin.'.$page)</strong></span>
            <ul class="options pull-left list-inline">
                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"></a></li>
                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen"><i class="fa fa-expand"></i></a></li>
                <li><a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> @lang('admin.addNewItem')</a></li>
                <li><a href="{{ url('/') }}/mtCPanel/students/import" class="btn btn-xs btn-success"><i class="fa fa-upload"></i> استيراد Excel / CSV</a></li>
            </ul>
        </div>
        <div class="panel-body"><div class="table-responsive">
            {{ $data->links() }}
            <table class="table table-striped table-bordered table-hover nomargin"><thead><tr>
                <th>#</th><th>@lang('admin.student_number')</th><th>@lang('admin.name_ar')</th><th>@lang('admin.name_en')</th><th>@lang('admin.college')</th><th>القسم</th><th>@lang('admin.academic_year')</th><th>@lang('admin.control')</th>
            </tr></thead><tbody>
            @foreach($data as $d)
                <tr><td>{{ $d->id }}</td><td>{{ $d->student_number }}</td><td>{{ $d->name_ar }}</td><td>{{ $d->name_en }}</td><td>{{ $d->college ? $d->college->name_ar : '—' }}</td><td>{{ $d->department ? ($d->department->titleEn ?: $d->department->title) : '—' }}</td><td>{{ $d->academic_year }}</td><td width="30%">
                    <a href="{{ mtGetRoute('show','mtCPanel.'.$page, $d->id) }}" class="btn btn-aqua btn-xs btn-3d btn-reveal"><i class="fa fa-eye white"></i> <span>عرض</span></a>
                    <a href="{{ mtGetRoute('edit','mtCPanel.'.$page, $d->id) }}" class="btn btn-yellow btn-xs btn-3d btn-reveal"><i class="fa fa-edit white"></i> <span>تحرير</span></a>
                    <a href="{{ url('/') }}/mtCPanel/students/{{ $d->id }}/results" class="btn btn-success btn-xs btn-3d btn-reveal"><i class="fa fa-list white"></i> <span>النتائج</span></a>
                    <a data-route="{{ mtGetRoute('destroy','mtCPanel.'.$page, $d->id) }}" class="deleteBtn btn btn-red btn-xs btn-3d btn-reveal"><i class="fa fa-times white"></i> <span>حذف</span></a>
                </td></tr>
            @endforeach
            </tbody></table>
        </div></div>
    </div></div>
@stop
@section('scripts')
<script>
$('.deleteBtn').on('click', function (){ var route=$(this).data('route'); Swal.fire({title:'هل أنت متأكد?',text:'سوف يتم مسح البيانات!',icon:'warning',showCancelButton:true,confirmButtonColor:'#3085d6',cancelButtonColor:'#d33',confirmButtonText:'نعم، قم بعملية المسح!'}).then((result)=>{if(result.value){$.ajax({url:route,type:'DELETE',dataType:'JSON',data:{'_token':'{{ csrf_token() }}'},success:function(){window.open('{{ url('/') }}/mtCPanel/{{ $page }}','_self');}});}}); });
</script>
@include('mtCPanel.alerts')
@stop