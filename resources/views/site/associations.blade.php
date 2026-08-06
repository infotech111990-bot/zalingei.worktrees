@extends('site.layouts.master')
@section('content')
{{--  <section class="page-header page-header-color page-header-primary">  --}}
<section class="page-header page-header-custom-background" style="background-image: url({{request()->root()}}/public/assets/porto/img/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-fw fa-check-square-o"></i>  @lang('site.associations')</h1>
				<ul class="breadcrumb breadcrumb-valign-mid">
					<li><a href="#">@lang('site.home')</a></li>
					<li class="active">@lang('site.associations')</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div class="container">
					<div class="featured-boxes">
						<div class="row">
                            <ul class="team-list">
                                @foreach($associations as $association)
                                    <li class="col-md-4 col-sm-6 col-xs-12 isotope-item">
                                        <span class="thumb-info thumb-info-hide-wrapper-bg mb-xlg">
                                            <span class="thumb-info-wrapper">
                                                <a href="{{request()->root()}}/associations/{{$association->id}}">
                                                    <img src="{{$association->getLogo()}}" class="img-responsive" alt="">
                                                    <span class="thumb-info-title">
                                                        <span class="thumb-info-inner" style="letter-spacing:1px;">@lang('site.getContent', ['ar'=>$association->title, 'en'=>$association->titleEn ])</span>
                                                        @if($association->establishment != null)
                                                            <span class="thumb-info-type"><i class="fa fa-fw fa-calendar"></i> @lang('site.getContent', ['ar'=>'تأسس في العام: '.$association->establishment, 'en'=>'Established in: '.$association->establishment ])</span>
                                                        @endif
                                                    </span>
                                                </a>
                                            </span>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
						</div>
					</div>


				</div>

			</div>

@stop