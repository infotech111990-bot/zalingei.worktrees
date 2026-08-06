<?php

namespace App\Http\Controllers;

use App\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        return view('site.services', ['services' => Service::orderBy('id','asc')->get()]);
    }

    public function display($id){
        return view('site.servicesDisplay', ['service' => Service::find($id)]);
    }
}
