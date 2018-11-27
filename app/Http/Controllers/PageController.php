<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Slide;
use App\Product;
use Illuminate\Http\Request;
use App\ProductType;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
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
    public function getDelItemCart($id)
    {
       $oldCart=Session::has('cart')?Session::get('cart'):null;
       $cart=new Cart($oldCart);
       
       
      $cart->removeItem($id);
        if(count($cart->items)>0)
      Session::put('cart',$cart);
    
      else
        Session::forget('cart');
      return redirect()->back();
       


    }
    public function getCheckout()
    {
          return view('page.dat-hang');    
    }
   public function postCheckout(Request $req)
   {
    $cart=Session::get('cart');
    //dd($cart);
    $customer=new Customer;
    $customer->name=$req->name;
    $customer->gender=$req->gender;
    $customer->email=$req->email;
    $customer->address=$req->address;
    $customer->phone_number=$req->phone;
    $customer->note=$req->notes;
    $customer->save();

    $bill=new Bill;
    $bill->id_customer=$customer->id;
    $bill->date_order=date('y-m-d');
    $bill->total=$cart->totalPrice;
    $bill->payment=$req->payment;
    $bill->note=$req->notes;
    $bill->save();

    foreach($cart->items as $key =>$value)
    {
      $bill_detail=new BillDetail;
      $bill_detail->id_bill=$bill->id;
      $bill_detail->id_product=$bill->id;
      $bill_detail->quantity=$value['qty'];
      $bill_detail->unit_price=($value['price']/$value['qty']);
      $bill_detail->save();

    }
    Session::forget('cart');
    return redirect()->back()->with('thongbao','Lưu thông tin thành công! ');
    }
    public function getLogin()
    {
      return view('page.dangnhap');
    }
    public function getSignin()
    {
      return view('page.dangki');
    }
    public function postLogin()
    {
          
    }
    public function postSignin(Request $req)
    {
       $this->validate($req,
        [
          'email'=>'required|email|unique:users,email',
          'password'=>'required|min:6|max:20',
          'fullname'=>'required',
          're_password'=>'required|same:password'

        ],
        [
          'email.required'=>'Vui lòng nhập email',
          'email.email'=>'Không đúng định dạng email',
          'email.unique'=>'Email đã có người sử dụng',
          'pasword.required'=>'vui lòng nhập mật khẩu',
          're_password.same'=>'Mật khẩu không giống nhau',
          'password.min'=>'Mật khẩu ít nhất 6 kí tự',
          'password.max'=>'Mật khẩu nhiều nhất 20 kí tự'

        ]);
       $user=new User();
       $user->full_name=$req->fullname;
       $user->email=$req->email;
       $user->password=Hash::make($req->password);
       $user->phone=$req->phone;
       $user->address=$req->address;
       $user->save();
       return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');


    }
    public function getSearch(Request $req)
    {
        $product =Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        return view('page.search',compact('product'));
    }
    public function demo()
    {
      return view('admin.user_list');
    }
}
