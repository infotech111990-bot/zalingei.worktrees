@extends('site.layouts.master')
@section('css')
    <link href="{{ asset('css/circular-progress-bars.css') }}" rel="stylesheet" type="text/css"><!-- CUSTOM STYLESHEET FOR STYLING -->
@stop

@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url({{ asset('autostars/images/' . Lang::get('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg'])) }}));">
        <div class="container">
            <h1 class="page-title">@lang('site.polls')</h1>
        </div>
    </div>
    
    <!-- Utiity Bar -->
    <div class="utility-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}/">@lang('site.home')</a></li>
                        <li><a href="{{ url('/') }}/polls">@lang('site.polls')</a></li>
                        <li class="active">@lang('site.getContent',['ar'=>$poll->title,'en'=>$poll->titleEn])</li>
                    </ol>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-4">
                    <ul class="utility-icons social-icons social-icons-colored">
                        @include('site.utilityBarLeft')
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="row">
					<div class="col-md-9">
						<div class="blog-posts">
							<article class="post post-medium">
								<div class="row">
									<div class="post-content">
										<h3 class="heading-primary" style="line-height:1.2em;">@lang('site.getContent',['ar'=>$poll->title,'en'=>$poll->titleEn])</h3>
										<hr>
											<i class="fa fa-fw fa-calendar"></i> {{$poll->startDate}} @lang('site.getContent',['ar'=>'إلى','en'=>'to']) {{$poll->endDate}}
                                        <hr>
										@foreach($poll->answers as $ans)
                                            <div class="col-md-{{ $ans->getGrids() }}">
                                                <div class="progress" data-percentage="{{ ceil($ans->getPercent()/10)*10 }}">
                                                    <span class="progress-left">
                                                        <span class="progress-bar"></span>
                                                    </span>
                                                    <span class="progress-right">
                                                        <span class="progress-bar"></span>
                                                    </span>
                                                    <div class="progress-value">
                                                        <div>
                                                            {{ $ans->getPercent() }}%<br>
                                                            <span>@lang('site.getContent',['ar'=>$ans->title,'en'=>$ans->titleEn])</span>
                                                        </div>
                                                    </div>
                                                </div>
												{{-- <div class="circular-bar">
													<div class="circular-bar-chart" data-percent="{{$ans->getPercent()}}" data-plugin-options="{'size': 175, 'lineWidth': 15, 'lineCap': 'square', 'scaleColor': '#999', 'barColor': '#CC8800'}">
														<strong>@lang('site.getContent',['ar'=>$ans->title,'en'=>$ans->titleEn])</strong>
														<label>%{{$ans->getPercent()}}</label>
													</div>
												</div> --}}
											</div>
										@endforeach
									</div>
								</div>
							</article>
						</div>
					</div>
                    <div class="col-md-3">
                        <aside class="sidebar">
                            <form>
                                <div class="input-group input-group-lg">
                                    <input class="form-control" placeholder="Search..." name="s" id="s" type="text">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <hr>
                            @include('site.newsMenu')
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
	<script>
        //pie
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [{
                data: [300, 50, 100, 40, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }]
            },
            options: {
            responsive: true
            }
        });
  	</script>
@endsection