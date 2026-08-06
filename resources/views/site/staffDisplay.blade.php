@extends('site.layouts.master')

@section('og')
    <meta property="og:title" content="{{ $staff->name }}">
    <meta property="og:description" content="{{ $staff->txt }}">
    <meta property="og:url" content="{{ $staff->getUrl() }}">
    <meta property="og:image" content="{{ $staff->getPicture() }}">
    
    <meta name="twitter:title" content="{{ $staff->name }} ">
    <meta name="twitter:description" content=" {{  $staff->txt  }}">
    <meta name="twitter:card" content="{{ $staff->getUrl() }}">
    <meta name="twitter:image" content="{{ $staff->getPicture() }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ request()->root() }}">@lang('site.home')</a></li>
            <li><a href="{{ request()->root() }}/staff">@lang('site.staff')</a></li>
            <li><a class="active">@lang('site.getContent',['ar'=>$staff->name, 'en'=>$staff->nameEn])</a></li>
        </ol>
    </div>
    <!-- end Breadcrumb -->

	<!-- Page Content -->
	<div id="page-content">
		<div class="container">
			<div class="row">
				<!--MAIN Content-->
				<div class="col-md-12">
					<div id="page-main">
						<section id="blog-detail">
                            <header><h1>{{ __('site.cv') }}</h1></header>
                            <div class="author-block member-detail" style="width:100%;">
                                <figure class="author-picture"><img src="{{ $staff->getPicture() }}" alt=""></figure>
                                <article class="paragraph-wrapper">
                                    <div class="inner">
                                        <header><h2>{{ $staff->trans('name','nameEn') }}</h2></header>
                                        <figure>
                                            <section id="share-post">
                                                <div class="icons">
                                                    <span>@lang('site.share'):</span>
                                                    <a href=""><i class="fa fa-twitter"></i></a>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $staff->getUrl() }}"><i class="fa fa-facebook"></i></a>
                                                    <a href=""><i class="fa fa-pinterest"></i></a>
                                                    <a href=""><i class="fa fa-youtube-play"></i></a>
                                                    <span class="pull-left"><span class="fa fa-eye"></span> {{ number_format($staff->views) }} {{ trans_choice('site.views',$staff->views) }}</span>
                                                </div><!-- /.icons -->
                                            </section>
                                            {{-- <span class="date"><span class="fa fa-file-o"></span> {{ date("Y-m-d",strtotime($staff->staff_date)) }}</span> --}}
                                        </figure>
                                        <hr>
                                        <p class="quote">
                                            {{ $staff->getStaffDegree() }}
                                            @if($staff->currentJob) - {{ $staff->currentJob }} @endif
                                        </p>
                                        <hr>
                                        <h3>{{ __('site.personalInformation') }}</h3>
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <tbody>
                                                @if($staff->trans('email','emailEn'))
                                                    <tr>
                                                        <th class="course-title">{{ __('admin.email') }}</th>
                                                        <th><span dir="ltr">{{ $staff->trans('email','emailEn') }}</span></th>
                                                    </tr>
                                                @endif
                                                @if($staff->dateOfBirth)
                                                    <tr>
                                                        <th class="course-title">{{ __('admin.dateOfBirth') }}</th>
                                                        <th><span dir="ltr">{{ $staff->dateOfBirth }}</span></th>
                                                    </tr>
                                                @endif
                                                @if($staff->trans('phone','phoneEn'))
                                                    <tr>
                                                        <th class="course-title">{{ __('admin.phone') }}</th>
                                                        <th><span dir="ltr">{{ $staff->trans('phone','phoneEn') }}</span></th>
                                                    </tr>
                                                @endif
                                                @if($staff->trans('mobile','mobileEn'))
                                                    <tr>
                                                        <th class="course-title">{{ __('admin.mobile') }}</th>
                                                        <th><span dir="ltr">{{ $staff->trans('mobile','mobileEn') }}</span></th>
                                                    </tr>
                                                @endif
                                                @if($staff->trans('city','cityEn'))
                                                    <tr>
                                                        <th class="course-title">{{ __('admin.city') }}</th>
                                                        <th>{{ $staff->trans('city','cityEn') }}</th>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <h3>{{ __('site.academicInformation') }}</h3>
                                        <div class="table-responsive">
                                            <table class="table table-condensed">
                                                <tbody>
                                                    @if($staff->college)
                                                        <tr>
                                                            <th class="course-title">{{ __('admin.college') }}</th>
                                                            <th>{{ __('site.getContent',['ar' => $staff->college->title, 'en' => $staff->college->titleEn]) }}</th>
                                                        </tr>
                                                    @endif
                                                    @if($staff->dept)
                                                        <tr>
                                                            <th class="course-title">{{ __('admin.dept') }}</th>
                                                            <th>{{ __('site.getContent',['ar' => $staff->dept->title, 'en' => $staff->dept->titleEn]) }}</th>
                                                        </tr>
                                                    @endif
                                                    @if($staff->trans('sp','spEn'))
                                                        <tr>
                                                            <th class="course-title">{{ __('admin.sp') }}</th>
                                                            <th>{{ $staff->trans('sp','spEn') }}</th>
                                                        </tr>
                                                    @endif
                                                    @if($staff->trans('subSp','subSpEn'))
                                                        <tr>
                                                            <th class="course-title">{{ __('admin.subSp') }}</th>
                                                            <th>{{ $staff->trans('subSp','subSpEn') }}</th>
                                                        </tr>
                                                    @endif
                                                    @if($staff->trans('dateOfHiring','dateOfHiringEn'))
                                                        <tr>
                                                            <th class="course-title">{{ __('admin.dateOfHiring') }}</th>
                                                            <th>{{ $staff->trans('dateOfHiring','dateOfHiringEn') }}</th>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        @if($staff->details->count() > 0)
                                            @foreach($staff->details as $d)
                                                <h3>{{ __('site.getContent', ['ar'=>$d->title,'en'=>$d->titleEn]) }}</h3>
                                                <div class="table-responsive">
                                                    {!! $d->trans('txt','txtEn') !!}
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </article>
                            </div>
						</section><!-- /.blog-detail -->

						<hr>

					</div><!-- /#page-main -->
				</div><!-- /.col-md-8 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div>
	<!-- end Page Content -->
@stop