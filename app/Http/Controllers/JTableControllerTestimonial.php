<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class JTableControllerTestimonial extends Controller
{
    //    protected $layout = "main";

    // --------------------- Testimonial List -------------------------------------------------
    public function testimonialList()
    {
        $order = explode(" ", request()->input('jtSorting'));
        $data = Testimonial::orderBy($order[0], $order[1])
                        ->take(request()->input('jtPageSize'))
                        ->skip(request()->input('jtStartIndex'))
                        ->get();
        $count = Testimonial::count();
        $result = array(
            'Result' => 'OK',
            'TotalRecordCount' => $count,
            'Records' => $data//->toArray()
        );
        return $result;
    }

    // --------------------- Testimonial Delete -------------------------------------------------
    public function testimonialDelete()
    {
        $id = request()->input('id');
        $TestimonialDelete = Testimonial::where('id','=',$id)->delete(); // Delete Testimonial
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }

    // --------------------- Testimonial Add -------------------------------------------------
    public function testimonialAdd(){
        $data = new Testimonial;

        $data->name        = request()->input('name');
        $data->nameEn        = request()->input('nameEn');
        $data->title        = request()->input('title');
        $data->titleEn        = request()->input('titleEn');
        $data->txt          = request()->input('txt');
        $data->txtEn          = request()->input('txtEn');
        $data->picture      = request()->input('picture');

        $data->save();
        $result = array(
            'Result' => 'OK',
            'Record' => $data //->toArray()
        );
        return $result;
    }

    // --------------------- Testimonial Update -------------------------------------------------
    public function testimonialUpdate(){
        $id = request()->input('id');

        $name        = request()->input('name');
        $nameEn        = request()->input('nameEn');
        $title        = request()->input('title');
        $titleEn        = request()->input('titleEn');
        $txt          = request()->input('txt');
        $txtEn          = request()->input('txtEn');
        $picture      = request()->input('picture');

        Testimonial::where('id','=',$id)->update(array(
            'name'        => $name,
            'nameEn'        => $nameEn,
            'title'        => $title,
            'titleEn'        => $titleEn,
            'txt'          => $txt,
            'txtEn'          => $txtEn,
            'picture'      => $picture
        ));
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        return json_encode($jTableResult);
    }

}
