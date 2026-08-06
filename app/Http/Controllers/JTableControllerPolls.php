<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\PollAns;
class JTableControllerPolls extends Controller
{
 //===========( Polls )===========================================================
 //----------(Show)---------------------------------------------------------------
 public function showPollJTable(){
     return view('mtCPanel.polls');
 }
//-----------( List )-------------------------------------------------------------
function pollList(){

    $order = explode(" ", request()->input('jtSorting'));
    $data = Poll::orderBy($order[0], $order[1])
                    ->take(request()->input('jtPageSize'))
                    ->skip(request()->input('jtStartIndex'))
                    ->get();
     $count = Poll::count();
     $result =[
            'Result' => 'OK',
            'TotalRecordCount' => $count,
            'Records' => $data//->toArray()
        ];
    
   return $result;
}

//-----------( Add )--------------------------------------------------------------
public function pollAdd(Request $request){
    
       
        $title         = $request->input('title');
        $titleEN       = $request->input('titleEn');
        $startDate     = $request->input('startDate');
        $endDate       = $request->input('endDate');
        $activate      = $request->input('activate');
         
         $data=[
            
        'title'        => $title,
        'titleEn'      => $titleEN,
        'startDate'    => $startDate,
        'endDate'      => $endDate,
        'activate'     => $activate,

         ];
        $polls = Poll::create($data);

        $result = array(
            'Result' => 'OK',
            'Record' => $polls //->toArray()
        );
        return $result;
    }
//-----------( Update )-----------------------------------------------------------
public function pollUpdate(Request $request){

           $id           = $request->input('id');
           $title        = $request->input('title');
           $titleEN      = $request->input('titleEn');
           $startDate    = $request->input('startDate');
           $endDate      = $request->input('endDate');
           $activate     = $request->input('activate');
    

    Poll::where('id','=',$id)->update([

           'title'       => $title,
           'titleEn'     => $titleEN,
           'startDate'   => $startDate,
           'endDate'     => $endDate,
           'activate'    => $activate,
        
        
           ]);
           $jTableResult = array();
           $jTableResult['Result'] = "OK";
           return json_encode($jTableResult);
}
//-----------( Delete )-----------------------------------------------------------
public function pollDelete(Request $request){
          $id      = $request->input('id');
          $polls = Poll::where('id','=',$id)->delete(); // Delete Polls
          $jTableResult = array();
          $jTableResult['Result'] = "OK";
          return json_encode($jTableResult);
}

//===========( Polls Answers)===========================================================
 
    //-----------( List )-----------------------------------------------------------
    public function pollansList($pollID)
    {
        $jtSorting = request()->input('jtSorting');
                    $data = new PollAns;
                    $data = $data->where('poll_id',$pollID);
                    if(isset($jtSorting) || $jtSorting != null){
                        $order = explode(" ", $jtSorting);
                        $data = PollAns::orderBy($order[0], $order[1])
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
    
    //-----------( Add )-----------------------------------------------------------
    public function pollsAnsAdd($pollID){
        
         $poll_id        = $pollID;
         $title          = request()->input('title');
         $titleEn        = request()->input('titleEn');
    
         $data = [  
         'poll_id'       =>$poll_id,
         'title'         =>$title,
         'titleEn'       =>$titleEn,
         ];
         $pollans = PollAns::create($data);
         
                 $result = array(
                     'Result' => 'OK',
                     'Record' => $pollans //->toArray()
                 );
                 return $result;
            
                }  
     //-----------( Update )-----------------------------------------------------------
     public function pollAnsUpdate(){
    
        $id          = request()->input('id');
        $poll_id     = request()->input('poll_id');
        $title       = request()->input('title');
        $titleEn     = request()->input('titleEn');
    
        $data = [
        'id'       =>$id,  
        'poll_id'  =>$poll_id,
        'title'    =>$title,
        'titleEn'  =>$titleEn,
        ];
      
          PollAns::where('id','=',$id)->update($data);
        
          $jTableResult = array();
          $jTableResult['Result'] = "OK";
          return json_encode($jTableResult);
             
     }
     //-----------( Delete )-----------------------------------------------------------
    public function pollAnsDelete(){
        $id           = request()->input('id');
        $pollans      = PollAns::where('id','=',$id)->delete(); // Delete Polls
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    } 
}
