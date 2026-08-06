<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollAns;
use App\News;
use App\Http\Controllers\Controller;

class PollController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $lang = \Lang::get('site.getContent', ['ar'=>'1','en'=>'2']);
        $latestNews = News::where('lang',$lang)->orderBy('created_at','DESC')->limit(3)->get();
        $mostReadNews = News::where('lang',$lang)->orderBy('readingCount','DESC')->limit(3)->get();    
        return view('site.polls', [
            'polls' => Poll::paginate(50),
            'latestNews' => $latestNews,
            'mostReadNews' => $mostReadNews
            ]);
    }

    public function display($id)
    {
        $lang = \Lang::get('site.getContent', ['ar'=>'1','en'=>'2']);
        $latestNews = News::where('lang',$lang)->orderBy('created_at','DESC')->limit(3)->get();
        $mostReadNews = News::where('lang',$lang)->orderBy('readingCount','DESC')->limit(3)->get();    
        return view('site.pollDisplay', [
            'poll' => Poll::findOrFail($id),
            'latestNews' => $latestNews,
            'mostReadNews' => $mostReadNews,
        ]);
    }

    public function voteNow(){
        $pollID = request()->input('pollID');
        $ansID = request()->input('ansID');
        $pollAns = PollAns::find($ansID);
        $pollAns->increment('count');
        $pollAns->save();
        return request()->root().'/polls/'.$pollID;
    }

}