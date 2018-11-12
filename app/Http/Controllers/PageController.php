<?php

namespace App\Http\Controllers;

use App\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()
    {
        $slide=Slide::all();
     //  print_r($slide);
       // exit();
        return view('page.trangchu',compact('slide'));


        //return view('page.trangchu',['slide'=>$slide]);
    }
    public function getLoaiSp(){
        return view('page.loai_sanpham');
    }
    public function getChitiet()
    {
        return view('page.chitiet_sanpham');
    }
    public function getLienHe()
    {
        return view('page.lienhe');
    }
    public function getAbout()
    {
        return view('page.about');
    }
}
