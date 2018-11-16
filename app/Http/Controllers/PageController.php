<?php

namespace App\Http\Controllers;

use App\Slide;
use App\Product;
use Illuminate\Http\Request;
use App\ProductType;

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
    public function getLoaiSp($type){
        $sp_theoloai=Product::where('id_type',$type)->get();
        //$sp_theoloai=Product::where('id_type',$type)->paginate(3);
        $sp_khac=Product::where('id_type','<>',$type)->paginate(3);
       // return view('page.loai_sanpham');
        $Tenloai=ProductType::where('id',$type)->first();
        $loai=ProductType::all();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','Tenloai'));
    }

    public function getChitiet(Request $req)
    {
        $sanpham=Product::where('id_type',$req->id)->first();
        return view('page.chitiet_sanpham',compact('sanpham'));
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
