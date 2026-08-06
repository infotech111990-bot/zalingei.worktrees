<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;

class JTableControllerLanguages extends Controller
{
    // --------------------- Languages Options -------------------------------------------------
    public function LanguagesOptions()
    {
            $data = Language::orderBy('languageCode','ASC')
                            ->get()->toArray();
            $rows = array();
        foreach($data as $d){
            $eil = array();
            $eil["DisplayText"] = $d['languageName'];
            $eil["Value"] = $d['languageCode'];
            $rows[] = $eil;
        }
        $result = array(
            'Result' => 'OK',
            'Options' => $rows //->toArray()
        );
        return json_encode($result);
    }
}
