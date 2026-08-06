<?php

namespace App\Http\Controllers;

use App\Page;
use App\News;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $lang = \Lang::get('site.getContent', ['ar'=>'1','en'=>'2']);
        $latestNews = News::where('lang',$lang)->orderBy('created_at','DESC')->limit(3)->get();
        $mostReadNews = News::where('lang',$lang)->orderBy('readingCount','DESC')->limit(3)->get();    
        return view('site.page', [
            'page' => Page::findOrFail($id),
            'latestNews' => $latestNews,
            'mostReadNews' => $mostReadNews
        ]);
    }

    public function showContactUs(){
        return view('site.contactUs');
    }

}