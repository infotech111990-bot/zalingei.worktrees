@extends('site.layouts.master')
@section('css')
<link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
@stop
@section('content')
<section class="my-breadcrumb">
	<div class="container page-banner">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-xs-12">
				<h1>@lang('site.atms')</h1>
				<ol class="breadcrumb">
					<li><a href="index.html">@lang('site.home')</a></li>
					<li><a href="">@lang('site.aboutUs')</a></li>
					<li class="active">@lang('site.eBankingServices')</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="blog-posts">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<aside>
					<div class="widget">
						<!--Recent Posts heading-->
						<h4>@lang('site.eBankingServices')</h4>
						<!--end Recent Posts--> 
						<!--Instagram section-->
						<ul class="categories-module">
							<?php $services = App\Service::all(); ?>
							@foreach($services as $s)
								<li><a href="{{$s->getLink()}}">{!! $s->name !!}</a></li>
							@endforeach
						</ul>
					</div>
				</aside>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="heading">
					<span class="heading-letter-style">@lang('site.pioneers')</span>
					<div class="main-heading-container">
						<h3>@lang('site.eBankingServices')</h3>
						<h1>@lang('site.atms')</h1>
					</div>
				</div>

				<img src="../includes/services/{{$service->picture}}" style="margin-bottom: 25px;" class="img-responsive" />
				<p>{!! $service->txt !!}</p>

				<h2 class="page-header">@lang('site.atmsLocations')</h2>
				<table id="atmsTable" class="display table table-striped table-condensed table-hover">
					<thead>
						<tr>
							<th>م</th>
							<th>@lang('site.city')</th>
							<th>@lang('site.atm')</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($atms as $atm)
							<tr>
								<td>{{$i++}}</td>
								<td>@lang('site.getContent', ['ar'=>$atm->city->name, 'en'=>$atm->city->nameEn ])</td>
								<td>@lang('site.getContent', ['ar'=>$atm->name, 'en'=>$atm->nameEn ])</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	<div>
</section>
@stop
@section('scripts')
	<script>
		$(document).ready(function() {
			$('#atmsTable').DataTable({
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
					search: 'ابحث عن صراف آلي: ',
					info: 'عرض الصفحة _PAGE_ من _PAGES_'
				}				
			});
		} );
	</script>
@stop