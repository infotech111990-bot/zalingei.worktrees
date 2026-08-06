<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Council;

class JTableControllerCouncils extends Controller
{
   // --------------------- show JTable -------------------------------------------------
   public function showCouncilJTable(){
    return view('mtCPanel.councils');
  }
  // --------------------- Council List -------------------------------------------------

  public function councilList()
      {
          $order = explode(" ", request()->input('jtSorting'));
          $data = Council::orderBy($order[0], $order[1])
                          ->take(request()->input('jtPageSize'))
                          ->skip(request()->input('jtStartIndex'))
                          ->get();
          $count = Council::count();
          $result = array(
              'Result' => 'OK',
              'TotalRecordCount' => $count,
              'Records' => $data//->toArray()
          );
          return $result;
      }
  
  // --------------------- Council Add -------------------------------------------------
  
      public function councilAdd(){
          $name             = request()->input('name');
          $nameEn           = request()->input('nameEn');
          $title              = request()->input('title');
          $titleEn            = request()->input('titleEn');
          $picture          = request()->input('picture');
          $order            = request()->input('order');
 
          $data = [
            'name'           => $name,    
            'title'            => $title,   
            'nameEn'         => $nameEn,  
            'titleEn'          => $titleEn,
            'picture'        => $picture,
            'order'          => $order
          ];
           $Council = Council::create($data);
          $result = [
  
              'Result' => 'OK',
  
              'Record' => $Council //->toArray()
  
          ];
  
          return $result;
      }
  
  // --------------------- Council Update -------------------------------------------------
  
      public function councilUpdate(){
  
          $id               = request()->input('id');
          $name             = request()->input('name');
          $title              = request()->input('title');
          $nameEn           = request()->input('nameEn');
          $titleEn            = request()->input('titleEn');
          $picture          = request()->input('picture');
          $order            = request()->input('order');
  
          Council::where('id','=',$id)->update([
  
          'name'           => $name,
          'nameEn'         => $nameEn,
          'title'            => $title,
          'titleEn'          => $titleEn,
          'picture'        => $picture,
          'order'          => $order
  
              ]);
  
          $jTableResult = [];
  
          $jTableResult['Result'] = "OK";
  
          return json_encode($jTableResult);
  
      }
      // --------------------- Council Delete -------------------------------------------------
  
      public function councilDelete()
          {
              $id = request()->input('id');
              $CouncilDelete = Council::where('id','=',$id)->delete(); // Delete Council
              $jTableResult = array();
              $jTableResult['Result'] = "OK";
              return json_encode($jTableResult);
          }
}
