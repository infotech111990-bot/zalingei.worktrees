<?php

namespace App\Http\Controllers;
use App\SiteLanguage;
use Illuminate\Http\Request;

class JTableControllerLocale extends Controller
{
// --------------------- show JTable -------------------------------------------------
    public function showLocaleJTable(){
    return view('mtCPanel.locale');
    }
   // --------------------- Locale List -------------------------------------------------
   public function localeList()
   {
       $order = explode(" ", request()->input('jtSorting'));
       $data = SiteLanguage::orderBy($order[0], $order[1])
                       ->take(request()->input('jtPageSize'))
                       ->skip(request()->input('jtStartIndex'))
                       ->get();
       $count = SiteLanguage::count();
       $result = array(
           'Result' => 'OK',
           'TotalRecordCount' => $count,
           'Records' => $data//->toArray()
       );
       return $result;
   }

// --------------------- Locale Add -------------------------------------------------
   public function localeAdd()
   {
       $data = new SiteLanguage;

       $var      = request()->input('var');
       $ar    = request()->input('ar');
       $en       = request()->input('en');

       $data =
       [
        'var'    => $var,
        'ar'  => $ar,
        'en'      => $en,
       ];
       SiteLanguage::create($data);
       $result = array(
           'Result' => 'OK',
           'Record' => $data //->toArray()
       );
       return $result;
   }

// --------------------- Locale Update -------------------------------------------------
   public function localeUpdate()
   {

       $id        = request()->input('id');
       $var      = request()->input('var');
       $ar    = request()->input('ar');
       $en       = request()->input('en');

       SiteLanguage::where('id','=',$id)->update(array(
           'var'    => $var,
           'ar'  => $ar,
           'en'     => $en,
       ));
       $jTableResult = array();
       $jTableResult['Result'] = "OK";
       return json_encode($jTableResult);
   }

// --------------------- Locale Delete -------------------------------------------------
   public function localeDelete()
   {
       $id = request()->input('id');
       $localeDelete = SiteLanguage::where('id','=',$id)->delete(); // Delete MainAds
       $jTableResult = array();
       $jTableResult['Result'] = "OK";
       return json_encode($jTableResult);
   }
   

}
