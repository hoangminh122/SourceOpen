<?php

namespace App\Http\Controllers;

use App\Slide;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getIndex()
    {
        $slide=Slide::all();
       // $new_product=Product::where('new',1)->get();
        $new_product=Product::where('new',1)->paginate(4);
        $sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(8);

     //  print_r($slide);
       // exit();
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));


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
