<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slider;

class JTableControllerSlider extends Controller
{
    // --------------------- show JTable -------------------------------------------------
    public function showSliderJTable(){
        return view('mtCPanel.slider');
      }
    // --------------------- Slider List -------------------------------------------------
    public function sliderList()
        {
            $order = explode(" ", request()->input('jtSorting'));
            $data = Slider::orderBy($order[0], $order[1])
                            ->take(request()->input('jtPageSize'))
                            ->skip(request()->input('jtStartIndex'))
                            ->get();
            $count = Slider::count();
            $result = array(
                'Result' => 'OK',
                'TotalRecordCount' => $count,
                'Records' => $data//->toArray()
            );
            return $result;
        }
      
      // --------------------- slider Add -------------------------------------------------
      
          public function sliderAdd(){
              $lang       = request()->input('lang');
              $text1       = request()->input('text1');
              $text2       = request()->input('text2');
              $text3     = request()->input('text3');
              $picture   = request()->input('picture');
              $startDate       = request()->input('startDate');
              $endDate       = request()->input('endDate');
              $url       = request()->input('url');
              $status       = 1;

              $data = [
                'lang' => $lang,
                'text1' => $text1,
                'text2' => $text2,
                'text3' => $text3,
                'picture' => $picture,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'url' => $url,
                'status' => $status
              ];
              $Slider = Slider::create($data);
              $result = [
                  'Result' => 'OK',
                  'Record' => $Slider //->toArray()
              ];
              return $result;
          }
      
      // --------------------- slider Update -------------------------------------------------
      
          public function sliderUpdate(){
      
              $id          = request()->input('id');
              $lang       = request()->input('lang');
              $text1       = request()->input('text1');
              $text2       = request()->input('text2');
              $text3     = request()->input('text3');
              $picture   = request()->input('picture');
              $startDate       = request()->input('startDate');
              $endDate       = request()->input('endDate');
              $url       = request()->input('url');
              $status       = request()->input('status');
              $status       = 1;
      
              Slider::where('id','=',$id)->update([
                'lang' => $lang,
                'text1' => $text1,
                'text2' => $text2,
                'text3' => $text3,
                'picture' => $picture,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'url' => $url,
                'status' => $status
              ]);
      
              $jTableResult = [];
              $jTableResult['Result'] = "OK";
              return json_encode($jTableResult);
      
          }
          // --------------------- Sliders Delete -------------------------------------------------
      
          public function sliderDelete()
         {
          
                  $id = request()->input('id');
                  $SlidersDelete = Slider::where('id','=',$id)->delete(); // Delete Sliders
                  $jTableResult = array();
                  $jTableResult['Result'] = "OK";
                  return json_encode($jTableResult);
          
              } 
}
