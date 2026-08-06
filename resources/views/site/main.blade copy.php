@extends('site.layouts.master')
@section('content')
<div class="hero-area">
        <!-- Start Hero Slider -->
        <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
            <ul class="slides">
                @foreach(App\Slider::getSliders() as $slider)
                    <li class="parallax" style="background-image:url({{$slider->getPicture()}});"></li>
                @endforeach
            </ul>
        </div>
        <!-- End Hero Slider -->
    </div>
    <!-- Utiity Bar -->
    <div class="utility-bar">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-sm-6 col-xs-8">
                </div>
            	<div class="col-md-8 col-sm-6 col-xs-4">
                	<ul class="utility-icons social-icons social-icons-colored">
                    	<li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    	<li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    	<li class="googleplus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    	<li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
          	</div>
      	</div>
    	<div class="by-type-options">
    		<div class="container">
               	<div class="row">
                  	<ul class="owl-carousel carousel-alt" data-columns="6" data-autoplay="" data-pagination="no" data-arrows="yes" data-single-item="no" data-items-desktop="6" data-items-desktop-small="4" data-items-mobile="3" data-items-tablet="4">
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/wagon.png" alt=""> <span>Wagon</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/minivan.png" alt=""> <span>Minivan</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/coupe.png" alt=""> <span>Coupe</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/convertible.png" alt=""> <span>Convertible</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/crossover.png" alt=""> <span>Crossover</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/suv.png" alt=""> <span>SUV</span></a></li>
                    	<li class="item"> <a href="results-list.html#"><img src="{{request()->root()}}/public/autostars/images/body-types/minicar.png" alt=""> <span>Minicar</span></a></li>
                    	<li class="item"> <a href="results-list.html"><img src="{{request()->root()}}/public/autostars/images/body-types/sedan.png" alt=""> <span>Sedan</span></a></li>
                  	</ul>
               	</div>
            </div>
        </div>
    </div>
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full padding-b0">
            <div class="container">
            	<!-- Welcome Content and Services overview -->
            	<div class="row">
                	<div class="col-md-6">
                    	<h1 class="uppercase strong">@lang('site.welcome')</h1>
                        <p class="lead">@lang('site.itsco')</p>
                    </div>
                    <div class="col-md-6">
                    	<p>@lang('site.aboutUsDesc')</p>
                    </div>
				</div>
				<hr class="divider">
                <div class="spacer-0"></div>
             	<div class="row">
                    <!-- Latest News -->
                    <div class="col-md-8 col-sm-6">
                        <section class="listing-block latest-news">
                            <div class="listing-header">
                            	<a href="{{ request()->root() }}/news" class="btn btn-sm btn-default pull-right">@lang('site.allNews')</a>
                                <h3>@lang('site.news')</h3>
                            </div>
                            <div class="listing-container">
                            	<div class="carousel-wrapper">
                                    <div class="row">
                                        <ul class="owl-carousel" id="news-slider" data-columns="2" data-autoplay="" data-pagination="yes" data-arrows="yes" data-single-item="no" data-items-desktop="2" data-items-desktop-small="1" data-items-tablet="2" data-items-mobile="1">
											@if(Config::get('app.locale') == 'ar')
												<?php $lastNews = App\News::where('lang',1)->orderBy('created_at','DESC')->limit(4)->get(); ?>
											@else
												<?php $lastNews = App\News::where('lang',2)->orderBy('created_at','DESC')->limit(4)->get(); ?>
											@endif
											@foreach($lastNews as $ln)
												<li class="item">
													<div class="post-block format-standard">
														<a href="{{request()->root()}}/news/{{$ln->id}}" class="media-box post-image"><img style="width:100%; height:200px;" src="{{$ln->getPicture()}}" alt=""></a>
														<div class="post-actions">
															<div class="post-date"> {{date('M', strtotime($ln->newsDate))}} {{date('d', strtotime($ln->newsDate))}}, {{date('Y', strtotime($ln->newsDate))}}</div>
															<div class="comment-count"><a href="{{request()->root()}}/news/{{$ln->id}}"><i class="icon-eye"></i> {{$ln->views}}</a></div>
														</div>
														<h3 class="post-title"><a href="{{request()->root()}}/news/{{$ln->id}}" style="direction:ltr;">{{Str::words(strip_tags($ln->title),10)}}</a></h3>
														<div class="post-content">
															<p>{{Str::words(strip_tags($ln->txt),20)}}</p>
														</div>
													</div>
												</li>
											@endforeach	
                                        </ul>
                                    </div>
                                </div>
                            </div>
                      	</section>
                		<div class="spacer-0"></div>
                        <!-- Latest Testimonials -->
                        <section class="listing-block latest-testimonials">
                            <div class="listing-container">
                            	<div class="carousel-wrapper">
                                    <div class="row">
                                        <ul class="owl-carousel carousel-fw" id="testimonials-slider" data-columns="2" data-autoplay="5000" data-pagination="no" data-arrows="no" data-single-item="no" data-items-desktop="2" data-items-desktop-small="1" data-items-tablet="1" data-items-mobile="1">
                                            <li class="item">
                                                <div class="testimonial-block">
													<h3>@lang('site.mission')</h3>
                                                    <blockquote>
                                                        <p align="justify">@lang('site.missionTxt')</p>
                                                    </blockquote>
                                                </div>
                                            </li>
                                            <li class="item">
												<div class="testimonial-block" >
													<h3>@lang('site.vision')</h3>
													<blockquote>
														<p align="justify">@lang('site.visionTxt')</p>
													</blockquote>
												</div>
											</li>
										</ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- Latest Reviews -->
                    <div class="col-md-4 col-sm-6 sidebar">
                        <section class="listing-block latest-reviews">
                            <div class="listing-header">
                            	<a href="{{ request()->root() }}/polls" class="btn btn-sm btn-default pull-right">@lang('site.allPolls')</a>
                                <h3>@lang('site.polls')</h3>
                            </div>
                            <div class="listing-container">
                                <?php $poll = App\Poll::first(); ?>
                            	<div class="post-block">
                                     <h3 class="post-title"><a href="single-post-review.html">@lang('site.getContent',['ar'=>$poll->title,'en'=>$poll->titleEn])</a></h3>
                                     @foreach($poll->answers as $ans)
										 <button class="btn btn-primary btn-sm form-control voteNow" data-poll-id="{{$poll->id}}" data-ans-id="{{$ans->id}}">@lang('site.getContent',['ar'=>$ans->title,'en'=>$ans->titleEn])</button>
                                     @endforeach
                                </div>
                            </div>
                      	</section>
                    </div>
              	</div>
           	</div>
        </div>
   	</div>
	<!-- End Body Content -->
	@endsection

@section('scripts')
	<script>
		$(document).ready( function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$('.voteNow').on('click', function(){
				var pollID = $(this).data('poll-id');
				var ansID = $(this).data('ans-id');
				$.post('polls/voteNow',{'pollID':pollID, 'ansID':ansID}, function(data){
					window.open(data,'_self');
				});
			});
		});
	</script>
@endsection