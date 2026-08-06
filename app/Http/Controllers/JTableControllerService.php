<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\ServiceDetails;

class JTableControllerService extends Controller
{
 // --------------------- show JTable -------------------------------------------------
  public function showServiceJTable(){
        return view('mtCPanel.services');
      }
 // --------------------- service List -------------------------------------------------
  
  public function serviceList()
          {
            $order = explode(" ", request()->input('jtSorting'));
            $data = Service::orderBy($order[0], $order[1])
                            ->take(request()->input('jtPageSize'))
                            ->skip(request()->input('jtStartIndex'))
                            ->get();
            $count = Service::count();
            $result = array(
                'Result' => 'OK',
                'TotalRecordCount' => $count,
                'Records' => $data//->toArray()
            );
            return $result;
      
          }
 
 // --------------------- services Add -------------------------------------------------
      
     public function serviceAdd(){

        $name        = request()->input('name');
        $nameEn      = request()->input('nameEn');
        $txt         = request()->input('txt');
        $txtEn       = request()->input('txtEn');
        $icon        = request()->input('icon');
        $picture     = request()->input('picture');
        $link        = request()->input('link');
        
        $data = [
        'name'       => $name,
        'nameEn'     => $nameEn,     
        'txt'        => $txt,   
        'txtEn'      => $txtEn, 
        'icon'       => $icon,  
        'picture'    => $picture,
        'link'       => $link
        ];
         $service = service::create($data);
         $result = [
           'Result' => 'OK',
            'Record' => $service //->toArray()
              ];
              return $result;
          }
      
// --------------------- services Update -------------------------------------------------
      
 public function serviceUpdate(){
      
        $id          = request()->input('id');
        $name        = request()->input('name');
        $nameEn      = request()->input('nameEn');
        $txt         = request()->input('txt');
        $txtEn       = request()->input('txtEn');
        $icon        = request()->input('icon');
        $picture     = request()->input('picture');
        $link        = request()->input('link');
      
        service::where('id','=',$id)->update([
        'name'       => $name,
        'nameEn'     => $nameEn,    
        'txt'        => $txt,   
        'txtEn'      => $txtEn, 
        'icon'       => $icon,  
        'picture'    => $picture,
        'link'       => $link
      ]);
      
         $jTableResult = [];
         $jTableResult['Result'] = "OK";
         return json_encode($jTableResult);
      
          }
// --------------------- services Delete -------------------------------------------------
      
   public function serviceDelete()
              {
          
         $id = request()->input('id'); 
         $servicesDelete = service::where('id','=',$id)->delete(); // Delete services 
         $jTableResult = array();
         $jTableResult['Result'] = "OK"; 
         return json_encode($jTableResult);
          
              }

 // --------------------- services Details List -------------------------------------------------
    
 public function serviceDetailsList($serviceID)
 
     {
         $jtSorting = request()->input('jtSorting');

         $data = new ServiceDetails;
         $data = $data->where('service_id',$serviceID);

         if(isset($jtSorting) || $jtSorting != null){
             $order = explode(" ", $jtSorting);
             $data = ServiceDetails::orderBy($order[0], $order[1])
                     ->take(request()->input('jtPageSize'))
                     ->skip(request()->input('jtStartIndex'));
         }
         $data = $data->get();
         $count = $data->count();
         $result = [
           'Result' => 'OK',
           'TotalRecordCount' => $count,
           'Records' => $data//->toArray()
         ];
         return $result;
     }
 
 // --------------------- service Add -------------------------------------------------
 
     public function serviceDetailsAdd($serviceID){
 
         $id               = request()->input('id');
         $service_id       =$serviceID;
         $title            = request()->input('title');
         $titleEn          = request()->input('titleEn');
         $info              = request()->input('info');
         $infoEn            = request()->input('infoEn');
 
         $data = 
         [
         'id'             => $id,
         'service_id'     => $service_id,
         'title'          => $title,
         'titleEn'        => $titleEn,
         'info'           => $info,
         'infoEn'         => $infoEn,
         ];
 
         $topics = ServiceDetails::create($data);
         $result = array(
             'Result' => 'OK',
             'Record' => $topics //->toArray()
         );
         return $result;
     }

 // --------------------- service Details Update -------------------------------------------------
 
     public function serviceDetailsUpdate(){
 
        $id               = request()->input('id');
        $service_id       =request()->input('service_id');;
        $title            = request()->input('title');
        $titleEn          = request()->input('titleEn');
        $info              = request()->input('info');
        $infoEn            = request()->input('infoEn');
 
         ServiceDetails::where('id','=',$id)->update([
 
            'id'             => $id,
            'service_id'     => $service_id,
            'title'          => $title,
            'titleEn'        => $titleEn,
            'info'            => $info,
            'infoEn'          => $infoEn,
 
         ]);
 
         $jTableResult = [];
         $jTableResult['Result'] = "OK";
         return json_encode($jTableResult);
     }
  // --------------------- services Details Delete -------------------------------------------------
 
  public function serviceDetailsDelete()
  {

      $id = request()->input('id');
      $ServiceDetailsDelete = ServiceDetails::where('id','=',$id)->delete(); 
      $jTableResult = array();
      $jTableResult['Result'] = "OK";
      return json_encode($jTableResult);

  }
 
 // --------------------- service Options -------------------------------------------------
 
     public function getOptions()
     {
        $services = Service::orderBy('id','ASC')->get();
             $options = [];      
             $arr = [];
             $arr['DisplayText'] = "اختر الخدمة";
             $arr['Value'] =null;
             $options[] = $arr;
                             
             foreach($services as $s){
             $arr = [];
             $arr['DisplayText'] = $s->name;
             $arr['Value']       = $s->id;
              $options[] = $arr;
             }
                             
              $result = [
              'Result' => 'OK',
              'Options' => $options //->toArray()
              ];
             return $result;
           
     }             
}
