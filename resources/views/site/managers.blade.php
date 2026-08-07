@extends('site.layouts.master')
<?php $page = App\Page::find(16); ?>
@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url({{ asset('autostars/images/' . Lang::get('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg'])) }}));">
        <div class="container">
            <h1 class="page-title">@lang('site.executiveManagers')</h1>
            </div>
    </div>

    <!-- Utiity Bar -->
    <div class="utility-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-8">
                    <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}/">@lang('site.home')</a></li>
                            <li class="active">@lang('site.aboutUs')</li>
                            <li class="active">@lang('site.executiveManagers')</li>
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

<!-- Start Body Content -->
<div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                  <div class="row">
                    <div class="col-md-9 posts-archive">
                            <div class="row">
                                    <ul class="sort-destination" data-sort-id="gallery">
                                      <?php $i=1; ?>
                                        @foreach($managers as $n)
                                            <li class="col-md-{{$n->getGrid()}} col-sm-{{$n->getGrid()}} grid-item format-image">
                                                <div class="grid-item-inner">
                                                    <a href="{{$n->getImage()}}" data-rel="prettyPhoto" class="media-box">
                                                      <img style="border:1px solid #CCC;" class="" src="{{$n->getImage()}}" alt=""> 
                                                    </a>
                                                </div>
                                                <h3><small>@lang('site.getContent', ['ar'=>$n->name, 'en'=>$n->nameEn])</small></h3>
                                                <h3 class="post-title"><small><a>@lang('site.getContent', ['ar'=>$n->title, 'en'=>$n->titleEn])</a></small></h3>
                                            </li>
                                            @if($i++%3 == 0)
                                              <br />
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>



                    </div>
                    <!-- Start Sidebar -->
                    <div class="col-md-3 sidebar">
                        @include('site.subMenu')
                    </div>

                  </div>
            </div>
       </div>
</div>
    <!-- End Body Content -->

@stop
