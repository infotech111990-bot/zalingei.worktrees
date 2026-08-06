<?php

namespace App\Http\Controllers;
use App\Site;
use Illuminate\Http\Request;

class JTableControllerSites extends Controller
{
// --------------------- show JTable -------------------------------------------------
    public function showsiteJTable(){
    return view('mtCPanel.sites');
    }
   // --------------------- Sites List -------------------------------------------------
   public function siteList()
   {
       $order = explode(" ", request()->input('jtSorting'));
       $data = Site::orderBy('id', 'DESC')
                       ->take(request()->input('jtPageSize'))
                       ->skip(request()->input('jtStartIndex'))
                       ->get();
       $count = Site::count();
       $result = array(
           'Result' => 'OK',
           'TotalRecordCount' => $count,
           'Records' => $data//->toArray()
       );
       return $result;
   }

// --------------------- Site Add -------------------------------------------------
   public function siteAdd()
   {
       $data = new Site;

       $name      = request()->input('name');
       $nameEn    = request()->input('nameEn');
       $url       = request()->input('url');

       $data =
       [
        'name'    => $name,
        'nameEn'  => $nameEn,
        'url'      => $url,
       ];
       Site::create($data);
       $result = array(
           'Result' => 'OK',
           'Record' => $data //->toArray()
       );
       return $result;
   }

// --------------------- Site Update -------------------------------------------------
   public function siteUpdate()
   {

       $id        = request()->input('id');
       $name      = request()->input('name');
       $nameEn    = request()->input('nameEn');
       $url       = request()->input('url');

       Site::where('id','=',$id)->update(array(
           'name'    => $name,
           'nameEn'  => $nameEn,
           'url'     => $url,
       ));
       $jTableResult = array();
       $jTableResult['Result'] = "OK";
       return json_encode($jTableResult);
   }

// --------------------- Site Delete -------------------------------------------------
   public function siteDelete()
   {
       $id = request()->input('id');
       $siteDelete = Site::where('id','=',$id)->delete(); // Delete MainAds
       $jTableResult = array();
       $jTableResult['Result'] = "OK";
       return json_encode($jTableResult);
   }
   

}
