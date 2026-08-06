<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager;

class JTableControllerManagers extends Controller
{
   // --------------------- show JTable -------------------------------------------------
   public function showManagerJTable(){
    return view('mtCPanel.managers');
  }
  // --------------------- Manager List -------------------------------------------------

  public function managerList()
      {
          $order = explode(" ", request()->input('jtSorting'));
          $data = Manager::orderBy($order[0], $order[1])
                          ->take(request()->input('jtPageSize'))
                          ->skip(request()->input('jtStartIndex'))
                          ->get();
          $count = Manager::count();
          $result = array(
              'Result' => 'OK',
              'TotalRecordCount' => $count,
              'Records' => $data//->toArray()
          );
          return $result;
      }
  
  // --------------------- Managers Add -------------------------------------------------
  
      public function ManagerAdd(){
          $name             = request()->input('name');
          $nameEn           = request()->input('nameEn');
          $title              = request()->input('title');
          $titleEn            = request()->input('titleEn');
          $text              = request()->input('text');
          $textEn            = request()->input('textEn');
          $sectionID          = request()->input('sectionID');
          $picture          = request()->input('picture');
          $order            = request()->input('order');
 
          $data = [
            'name'           => $name,    
            'nameEn'         => $nameEn,  
            'title'            => $title,   
            'titleEn'          => $titleEn,
            'text'            => $text,   
            'textEn'          => $textEn,
            'sectionID'        => $sectionID,
            'picture'        => $picture,
            'order'          => $order
          ];
           $Manager = Manager::create($data);
          $result = [
  
              'Result' => 'OK',
  
              'Record' => $Manager //->toArray()
  
          ];
  
          return $result;
      }
  
  // --------------------- Managers Update -------------------------------------------------
  
      public function ManagerUpdate(){
  
          $id               = request()->input('id');
          $name             = request()->input('name');
          $nameEn           = request()->input('nameEn');
          $title              = request()->input('title');
          $titleEn            = request()->input('titleEn');
          $text              = request()->input('text');
          $textEn            = request()->input('textEn');
          $sectionID          = request()->input('sectionID');
          $picture          = request()->input('picture');
          $order            = request()->input('order');
  
          Manager::where('id','=',$id)->update([
  
          'name'           => $name,
          'nameEn'         => $nameEn,
          'title'            => $title,
          'titleEn'          => $titleEn,
          'text'            => $text,
          'textEn'          => $textEn,
          'sectionID'        => $sectionID,
          'picture'        => $picture,
          'order'          => $order
  
              ]);
  
          $jTableResult = [];
  
          $jTableResult['Result'] = "OK";
  
          return json_encode($jTableResult);
  
      }
      // --------------------- Managers Delete -------------------------------------------------
  
      public function ManagerDelete()
          {
              $id = request()->input('id');
              $ManagersDelete = Manager::where('id','=',$id)->delete(); // Delete Managers
              $jTableResult = array();
              $jTableResult['Result'] = "OK";
              return json_encode($jTableResult);
          }
}
