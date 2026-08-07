@extends('site.layouts.master')
@section('content')
   <!-- Start Page header -->
   <div class="page-header parallax" style="background-image:url({{ asset('autostars/images/' . Lang::get('site.getContent',['ar'=>'custom-header-bg.jpg','en'=>'custom-header-bg.en.jpg'])) }}));">
    <div class="container">
        <h1 class="page-title">API Test</h1>
    </div>
</div>

<!-- Utiity Bar -->
<div class="utility-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-8">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}/">@lang('site.home')</a></li>
                    <li class="active">API Test</li>
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

<?php 
    $url = 'https://newsapi.org/v2/everything?q=bitcoin&from=2018-11-17&sortBy=publishedAt&apiKey=f7295f8775fd4c719e4b6ada59197eb1'; 
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $re_str = curl_exec($ch);
    curl_close($ch);
    $re_list = json_decode($re_str, true);
?>

<div class="main" role="main">
    <div id="content" class="content full">
        <div class="container">
            <div class="row">
                <h3>{{ 5/3 }}</h3>
                <p>
                    {{-- {{ dd($re_list) }} --}}
                    <?php $i=0; ?>
                    @foreach($re_list['articles'] as $article)
                        <div class="col-md-3">
                            <p><img style="height:220px;" width="100%" src="{{ $article['urlToImage'] }}" /></p>
                            <h4><a href="{{ $article['url'] }}">{{ $article['title'] }}</a></h4>
                            <p class="mb-0">{{ $article['author'] }}</p>
                        </div>
                        @if($i++%4 == 3)
                            <div class="clearfix"></div>
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>    
@endsection