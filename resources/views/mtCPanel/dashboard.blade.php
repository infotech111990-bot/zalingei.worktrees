@extends('mtCPanel.layouts.master')

@section('breadcrumb')
		<li>
			<i class="fa fa-home"></i>
			<a href="#">@lang('site.home')</a>
		</li>
		<li class="active">لوحة التحكم</li>
@endsection

@section('header-title')
	لوحة التحكم
@endsection

@section('content')

<div class="row">

    <!-- Panel Tabs -->
    <div id="panel-ui-tan-l1" class="panel panel-default">

        <div class="panel-heading">

            <!-- tabs nav -->
            <ul class="nav nav-tabs pull-right">
                <?php $i=0 ;?>
                @foreach(Config::get("mtcpanel.dashboardMenuArr") as $DBM)
                    <li class="@if(($i++)==0) active @endif"><!-- TAB 1 -->
                        <a href="#tab-{{$DBM['sectionID']}}" data-toggle="tab"> {{$DBM['sectionTitle']}} </a>
                    </li>
                @endforeach
            </ul>
            <!-- /tabs nav -->

        </div>
        <!-- panel content -->
        <div class="panel-body">

            <!-- tabs content -->
            <div class="tab-content transparent">
                <?php $j=0 ;?>
                @foreach(Config::get("mtcpanel.dashboardMenuArr") as $DBM)
                    <div role="tab-{{$DBM['sectionID']}}" class="tab-pane @if(($j++)==0) active @endif" id="tab-{{$DBM['sectionID']}}">
                        @foreach($DBM['menuData'] as $DBMItem)
                            @if(auth()->guard('admin')->user()->hasMainPriv($DBMItem['menuID']))
                                <div class="col-md-3 col-sm-3 col-lg-3">
                                    <div class="box default"><!-- default, danger, warning, info, success -->
                                        <div class="box-title"><!-- add .noborder class if box-body is removed -->
                                            <h4><a href="{{Request::root()}}/mtCPanel/{{$DBMItem['menuID']}}">{{Lang::get("admin.".$DBMItem['menuID'])}}</a></h4>
                                            <span class="block">{{Lang::get("admin.".$DBMItem['menuID'])}}</span>
                                            <i class="fa fa-{{$DBMItem['menuIcon']}}" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <!-- /panel content -->
        </div>
        <!-- /Panel Tabs -->
    </div>
</div>

@stop