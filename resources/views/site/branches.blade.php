@extends('site.layouts.master')
<?php $page = App\Page::find(8); ?>
@section('css')
<link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
@stop
@section('content')
<section class="my-breadcrumb">
	<div class="container page-banner">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<h1>@lang('site.branches')</h1>
				<ol class="breadcrumb">
					<li><a href="index.html">@lang('site.home')</a></li>
					<li><a href="">@lang('site.aboutUs')</a></li>
					<li class="active">@lang('site.branches')</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="blog-posts">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				@include('site.subMenu')
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				
				<div class="heading">
					<span class="heading-letter-style">@lang('site.pioneers')</span>
					<div class="main-heading-container">
						<h3>@lang('site.aboutUs')</h3>
						<h1>@lang('site.branches')</h1>
					</div>
				</div>
				
				<table id="branchesTable" class="table table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>@lang('site.branch')</th>
							<th>@lang('site.city')</th>
							<th>@lang('site.ext')</th>
							<th>@lang('site.type')</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($branches as $branch)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$branch->name}}</td>
								<td>{{$branch->city->name}}</td>
								<td>{{$branch->phone}}</td>
								<td>{{$branch->type->name}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
			$('#branchesTable').DataTable({
				pagingType: 'full',
				language: {
					paginate: {
						first:    '«',
						previous: '‹',
						next:     '›',
						last:     '»'
					},
					aria: {
						paginate: {
							first:    'الأول',
							previous: 'السابق',
							next:     'اللاحق',
							last:     'الأخير'
						}
					},
					search: 'ابحث عن فروع البنك: ',
					info: 'عرض الصفحة _PAGE_ من _PAGES_'
				}				
			});
		} );
	</script>
@stop