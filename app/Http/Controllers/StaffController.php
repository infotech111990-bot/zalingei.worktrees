<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;

class StaffController extends Controller
{
    public function display($id = null, $slug = null){
        $staff = Staff::find($id);
        $staff->increment('views');
        $staff->save();
        return view('site.staffDisplay',['staff' => $staff]);
    }
}