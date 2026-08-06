<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ManagerType;

class JTableControllerManagerType extends Controller
{
    public function getOptions(){
        
        $types = ManagerType::get();
        
        $options = [];

            $arr = [];
            $arr['DisplayText'] = "اختر الفئة";
            $arr['Value'] =null;
        
            $options[] = $arr;
        
        foreach($types as $t){
            $arr = [];
            $arr['DisplayText'] = $t->title;
            $arr['Value']       = $t->id;
            $options[] = $arr;
        }
        
        $result = array(
            'Result' => 'OK',
            'Options' => $options //->toArray()
        );
        return $result;
    }
}
