<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Slide;
use App\Product;
use Illuminate\Http\Request;
use App\ProductType;
use Illuminate\Support\Facades\Session;
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

   // public function getChitiet(Request $req)
    public function getChitiet($id)
    {
        $sanpham_khuyenmai1=Product::where('new','<>',0)->paginate(4);
        $new_product1=Product::where('new',1)->paginate(4);
        $sanpham=Product::where('id_type',$id)->first();
      //  $sanpham=Product::where('id_type',$req->id)->first();
        $sanphamtuongtu=Product::where('id_type',$sanpham->id_type)->paginate(3);
        return view('page.chitiet_sanpham',compact('sanpham','sanphamtuongtu','sanpham_khuyenmai1','new_product1'));
    }
    public function getLienHe()
    {
        return view('page.lienhe');
    }
    public function getAbout()
    {
        return view('page.about');
    }
    public function getAddtoCart(Request $req,$id)
    {
        $product=Product::find($id);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
}
