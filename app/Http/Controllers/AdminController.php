<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mtCPanel.dashboard');
    }

    //------------------ Pages ----------------------------------------------
    public function showPages(){
		return view('mtCPanel.pages');
	}

    //------------------ News ----------------------------------------------
    public function showNews(){
		return view('mtCPanel.news');
	}

    //------------------ News ----------------------------------------------
    public function showTestimonial(){
		return view('mtCPanel.testimonial');
	}

}