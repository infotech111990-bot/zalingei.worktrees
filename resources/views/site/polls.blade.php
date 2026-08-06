@extends('site.layouts.master')
@section('content')
    <!-- Start Page header -->
    <div class="page-header parallax" style="background-image:url({{request()->root()}}/public/autostars/images/@lang('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg']));">
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
                        <li><a href="{{request()->root()}}/">@lang('site.home')</a></li>
                        <li class="active">@lang('site.polls')</li>
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
                    @if($polls->count() > 0)
                        <div class="col-md-9">
                            <div class="blog-posts">
                                {{$polls->links()}}
                                @foreach($polls as $n)
                                    <article class="post post-medium">
                                        <div class="row">
											<div class="post-content">
												<h3><a href="polls/{{$n->id}}"><i class="fa fw fa-circle-o" aria-hidden="true"></i> {{Str::words(strip_tags($n->title),5)}}</a></h3>
											</div>
                                        </div>
                                    </article>
                                @endforeach
                                {{$polls->links()}}
                            </div>
                        </div>
                    @else
                        <div class="col-md-9">
                            <div class="alert alert-primary alert-dismissible show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                @lang('site.nopollsAvailable')
                            </div>
                        </div>
                    @endif
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