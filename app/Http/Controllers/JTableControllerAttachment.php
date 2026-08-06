<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Attachment;

class JTableControllerAttachment extends Controller
{
    // --------------------- show JTable -------------------------------------------------
    public function showAttachmentJTable(){
        return view('mtCPanel.attachments');
      }
    // --------------------- Attachment List -------------------------------------------------
    public function attachmentsList()
        {
            $order = explode(" ", request()->input('jtSorting'));
            $data = Attachment::orderBy($order[0], $order[1])
                            ->take(request()->input('jtPageSize'))
                            ->skip(request()->input('jtStartIndex'))
                            ->get();
            $count = Attachment::count();
            $result = array(
                'Result' => 'OK',
                'TotalRecordCount' => $count,
                'Records' => $data//->toArray()
            );
            return $result;
        }
      
      // --------------------- attachments Add -------------------------------------------------
      
          public function attachmentsAdd(){
              $title       = request()->input('title');
              $file         = request()->input('file');
              $desc        = request()->input('desc');
              $size        = request()->input('size');
              $ext         = request()->input('ext');

              $data = [
                'title'      => $title,   
                'file'        => $file,
                'desc'       => $desc,
                'size'       => $size,
                'ext'        => $ext
              ];
              $Attachment = Attachment::create($data);
              $result = [
                  'Result' => 'OK',
                  'Record' => $Attachment //->toArray()
              ];
              return $result;
          }
      
      // --------------------- attachments Update -------------------------------------------------
      
          public function attachmentsUpdate(){
      
              $id          = request()->input('id');
              $title       = request()->input('title');
              $file         = request()->input('file');
              $desc        = request()->input('desc');
              $size        = request()->input('size');
              $ext         = request()->input('ext');
      
              Attachment::where('id','=',$id)->update([
      
              'title'      => $title,   
              'file'        => $file,
              'desc'       => $desc,
              'size'       => $size,
              'ext'        => $ext
                  ]);
      
              $jTableResult = [];
              $jTableResult['Result'] = "OK";
              return json_encode($jTableResult);
      
          }
          // --------------------- Attachments Delete -------------------------------------------------
      
          public function attachmentsDelete()
         {
          
                  $id = request()->input('id');
                  $AttachmentsDelete = Attachment::where('id','=',$id)->delete(); // Delete Attachments
                  $jTableResult = array();
                  $jTableResult['Result'] = "OK";
                  return json_encode($jTableResult);
          
              } 
}
