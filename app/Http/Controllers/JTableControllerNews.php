<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsCat;

class JTableControllerNews extends Controller
{
    //    protected $layout = "main";

    // --------------------- News List -------------------------------------------------
    public function newsList()
    {
        $order = explode(" ", request()->input('jtSorting'));
        $data = News::orderBy($order[0], $order[1])
                        ->take(request()->input('jtPageSize'))
                        ->skip(request()->input('jtStartIndex'))
                        ->get();
        $count = News::count();
        $result = array(
            'Result' => 'OK',
            'TotalRecordCount' => $count,
            'Records' => $data//->toArray()
        );
        return $result;
    }

    // --------------------- News Delete -------------------------------------------------
    public function newsDelete()
    {
        $id = request()->input('id');
        $newsDelete = News::where('id','=',$id)->delete(); // Delete News
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }

    // --------------------- News Add -------------------------------------------------
    public function newsAdd(){
        $data = new News;

        $data->title        = request()->input('title');
        $data->shortTxt     = request()->input('shortTxt');
        $data->txt          = request()->input('txt');
        $data->picture      = request()->input('picture');
        $data->marquee      = request()->input('marquee');
        $data->cat          = request()->input('cat');
        $data->lang         = request()->input('lang');
        $data->readingCount = 0;
        $data->newsDate     = date('Y-m-d');

        $data->save();
        $result = array(
            'Result' => 'OK',
            'Record' => $data //->toArray()
        );
        return $result;
    }

    // --------------------- News Update -------------------------------------------------
    public function newsUpdate(){
        $id = request()->input('id');

        $title        = request()->input('title');
        $shortTxt     = request()->input('shortTxt');
        $txt          = request()->input('txt');
        $picture      = request()->input('picture');
        $marquee      = request()->input('marquee');
        $cat          = request()->input('cat');
        $lang         = request()->input('lang');
        $readingCount = 0;
        $newsDate     = date('Y-m-d');

        News::where('id','=',$id)->update(array(
            'title'        => $title,
            'shortTxt'     => $shortTxt,
            'txt'          => $txt,
            'picture'      => $picture,
            'marquee'      => $marquee,
            'cat'          => $cat,
            'lang'         => $lang,
            'readingCount' => $readingCount,
        ));
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }

    // --------------------- News Cats List -------------------------------------------------
    public function newsCatsList()
    {
        $order = explode(" ", request()->input('jtSorting'));
        $data = NewsCat::orderBy($order[0], $order[1])
                        ->take(request()->input('jtPageSize'))
                        ->skip(request()->input('jtStartIndex'))
                        ->get();
        $count = NewsCat::count();
        $result = array(
            'Result' => 'OK',
            'TotalRecordCount' => $count,
            'Records' => $data//->toArray()
        );
        return $result;
    }

    // --------------------- News Cats Delete -------------------------------------------------
    public function newsCatsDelete()
    {
        $id = request()->input('id');
        $catsDelete = NewsCat::where('id','=',$id)->delete(); // Delete News
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }

    // --------------------- News Cats Add -------------------------------------------------
    public function newsCatsAdd(){
        $data = new NewsCat;

        $data->title      = request()->input('title');
        $data->titleEn    = request()->input('titleEn');
        $data->txt       = request()->input('txt');
        $data->txtEn     = request()->input('txtEn');

        $data->save();
        $result = array(
            'Result' => 'OK',
            'Record' => $data //->toArray()
        );
        return $result;
    }

    // --------------------- News Cats Update -------------------------------------------------
    public function newsCatsUpdate(){
        $id = request()->input('id');

        $title   = request()->input('title');
        $titleEn = request()->input('titleEn');
        $txt    = request()->input('txt');
        $txtEn  = request()->input('txtEn');

        NewsCat::where('id','=',$id)->update(array(
            'title'          => $title,
            'titleEn'        => $titleEn,
            'txt'           => $txt,
            'txt'           => $txtEn,
        ));
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }


    // --------------------- News Options -------------------------------------------------
    public function newsCatsOptions()
    {
            $data = NewsCat::orderBy('id','ASC')
                            ->get()->toArray();
            $rows = array();
                $eil = array();
                $eil["DisplayText"] = "عنوان رئيسي";
                $eil["Value"] = 0;
            $rows[] = $eil;
        foreach($data as $d){
            $eil = array();
            $eil["DisplayText"] = $d['title'];
            $eil["Value"] = $d['id'];
            $rows[] = $eil;
        }
        $result = array(
            'Result' => 'OK',
            'Options' => $rows //->toArray()
        );
        return json_encode($result);
    }
}
