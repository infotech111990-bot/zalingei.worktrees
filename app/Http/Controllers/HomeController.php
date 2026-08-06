<?php

namespace App\Http\Controllers;

use App\Page;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function main()
    {
        return view('site.main');
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect('/');
    }
}