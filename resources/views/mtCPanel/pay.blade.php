@extends('admin.layouts.master')
@section('content')
<?php $payments = Payments::where('ID','=',$member->ID)->paginate(10); ?>

	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Pay for Member</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<nav class="navbar navbar-default" role="navigation">
			<ul class="nav navbar-top-links navbar-left">
				<li><a href="{{Request::root()}}/admin/users"><strong>Users</strong></a></li>
				<li><i class="fa fa-angle-right fa-fw"></i></li>
				<li><a href="{{Request::root()}}/admin/users/display/{{$member->ID}}"><strong>{{$member->username}}</strong></a></li>
				<li><i class="fa fa-angle-right fa-fw"></i></li>
				<li>Pay</li>
			</ul>
			<!-- /.navbar-header -->
		</nav>
	</div>
	
	<div class="row">
		<form class="form" method="post">
			<input class="noEnterSubmit" name="userID" type="hidden" value="{{$member->ID}}" class="form-control">
			<input class="noEnterSubmit" name="maximumAmount" id="maximumAmount" type="hidden" value="{{number_format($member->getCurrentBalance())}}" class="form-control">
			<label>
				Amount [ Maximum amount = ${{number_format($member->getCurrentBalance())}} ]
			</label>
			<input class="noEnterSubmit form-control" name="amount" id="amount" type="text" value="{{number_format($member->getCurrentBalance())}}">
			<input class="noEnterSubmit form-control" name="amountInSDG" id="amountInSDG" type="text" readonly value="{{number_format($member->getCurrentBalance())*6}}">
			<input type="submit" name="makePaymentButton" id="makePaymentButton" value="Make Payment" class="form-control btn-warning noEnterSubmit" />
		</form>
	</div>
@stop