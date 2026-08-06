@extends('mtCPanel.layouts.master')

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="{{  request()->root() }}/mtCPanel">@lang('admin.cpanel')</a>
		</li>
		<li class="active">@lang('admin.members')</li>
@endsection

@section('header-title')
	@lang('admin.members')
@endsection


@section('content')
	<div class="row">
		<div id="panel-1" class="panel panel-default">
            <div class="panel-heading">
				<span class="title elipsis">
					<strong>@lang('admin.members')</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-left list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
					{{-- <li><a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-xs btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a></li> --}}
				</ul>
				<!-- /right options -->

            </div>
            <!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover nomargin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $members as $member )
                                <tr>
                                    <td><img class="thumbnail" src="{{ $member->picture }}" width="75"></td>
                                    <td scope="row">{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone_no }}</td>
                                    <td>
                                        @if($member->isExpiredMembership())
                                            <span class="label label-danger"> Expired </span>
                                        @endif
                                        @if($member->isActiveMembership())
                                            <span class="label label-success"> Active </span>
                                        @endif
                                        @if($member->isNewRequest())
                                            <span class="label label-warning"> New Request </span>
                                        @endif
                                        @if($member->isConfirmed())
                                            <span class="label label-info"> Wating for Payment </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ str_pad(25, 8, '0', STR_PAD_LEFT) }}
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
    
@stop