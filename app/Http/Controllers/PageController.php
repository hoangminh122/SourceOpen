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
     public function getuser_list()
    {
      $user=User::all();


      return view('admin.user_list',['user'=>$user]);
    }
    public function getdelUser($id)
    {
      $spdel=User::find($id);
      $spdel->delete();

      return redirect('admin_sp')->with('thanhcong','Xoa nguoi dung mới thành công');
    }
    public function getdel($id)
    {
      $spdel=Product::find($id);
      $spdel->delete();

     return redirect('admin_sp')->with('thanhcong','Xoa sản phẩm mới thành công');
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
    public function postLogin(Request $req)
    {
      $users= User::where('email',$req->email)->first();
      if($users!=null)
      {
          if (Hash::check($req->pass,$users->password)) 
          {
             $sp_new=Product::where('new',1)->get();
      return view('admin.spmoi_list',compact('sp_new'));
          }
      }
      else return redirect()->back()->with('thongbao','Mật khẩu hoặc tài khoản không đúng .');
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

      $sp_new=Product::where('new',1)->get();
      return view('admin.spmoi_list',compact('sp_new'));
    }
     public function get_add_spmoi()
    {

    // $sp_new=Product::where('new',1)->get();
      return view('admin.spmoi_add');
    }
    public function get_update_spmoi($id)
    {
      $sp_update=Product::find($id);
      $tentheloai=ProductType::find($sp_update->id_type);
      $tentl=$tentheloai->name;
       return view('admin.spmoi_update',['sp_update'=>$sp_update,'tentl'=>$tentl]);

    }
    public function post_update_spmoi(Request $req,$id)
    {
       $sp_update=Product::find($id);
      //$sp_name=ProductType::where('id',$req->select)->first();
      $mang=array(
        'name'=>$sp_update->name,
        'unit_price'=>$sp_update->unit_price,
        'promotion_price'=>$sp_update->promotion_price,
        'description'=>$sp_update->description,
        'image'=>$sp_update->image,
        'unit'=>$sp_update->unit,
        'id_type'=>$req->select

      );
       
       if($req->name!=null)
       {
                   $this->validate($req,[
                    'name'=>'string|min:6|max:50'      
               ],
               [
                'name.string'=>'Tên sản phẩm không hợp lệ .' ]);
            $mang['name']=$req->name;
       }
       else if($req->unit_price!=null)
         {
                    $this->validate($req,[
                    'unit_price'=>'numberic|min:6|max:50'      
               ],
               [
                'unit_price.numberic'=>'giá sản phẩm không hợp lệ .' ]);
                      $mang['unit_price']=$req->unit_price;
         }
        else if($req->promotion_price!=null)
        {
                   $this->validate($req,[
                    'promotion_price'=>'numberic|min:6|max:50'      
               ],
               [
                'promotion_price.numberic'=>'giá sản phẩm không hợp lệ .' ]);
                     $mang['promotion_price']=$req->promotion_price;
        }
        else if($req->description!=null)
        {
                   $this->validate($req,[
                    'description'=>'string|min:6|max:50'      
               ],
               [
                'description.string'=>'Mô tả sản phẩm không hợp lệ .' ]);
                   $mang['description']=$req->description;
        }
       else if($req->image!=null)
       {
                   $this->validate($req,[
                    'image'=>'string|min:6|max:50'      
               ],
               [
                'image.string'=>'Tên hình ảnh không hợp lệ .' ]);
                   $mang['image']=$req->image;
       }
        else if($req->unit!=null)
       {
                   $this->validate($req,[
                    'image'=>'string|min:6|max:50'      
               ],
               [
                'image.string'=>'Tên hình ảnh không hợp lệ .' ]);
                   $mang['unit']=$req->unit;
       }
    
       
   $sp_update->name=$mang['name'];
   $sp_update->image=$mang['image'];
   $sp_update->description=$mang['description'];
   $sp_update->unit_price=$mang['unit_price'];
   $sp_update->promotion_price=$mang['promotion_price'];
   $sp_update->unit=$mang['unit'];
   $sp_update->id_type=$mang['id_type'];
   $sp_update->save();
 return redirect('admin_sp')->with('thanhcong','Cập nhật sản phẩm mới thành công');

    }
    public function post_add_spmoi(Request $req)
    {
     $this->validate($req,[
     
          'description'=>'required|min:6|max:30',
          'unit_price'=>'required|numeric|min:4',
          'promotion_price'=>'required|numeric|min:4',
          'image'=>'required|min:4',
          
     ],
     [
      'description.required'=>'Vui lòng nhập mô tả',
      'description.min'=>'Mô tả không phù hợp !',
      'unit_price.required'=>'Vui lòng nhập mô tả',
      'unit_price.numeric'=>'Vui lòng nhập dạng số',
      'promotion_price.required'=>'Vui lòng nhập mô tả',
      'promotion_price.numeric'=>'Vui lòng nhập dạng số',

      'image.required'=>'Vui lòng nhập mô tả',


     ]);
     $sp_name=ProductType::where('id',$req->select)->first();
   //  echo $sp_name->name;
     $sp_add=new Product();
     $sp_add->name=$req->$sp_name;
     $sp_add->description=$req->description;
     $sp_add->id_type=$req->select;
      $sp_add->unit_price=$req->unit_price;
       $sp_add->promotion_price=$req->promotion_price;
        $sp_add->image=$req->image.'.jpg';
         $sp_add->new=1;
          $sp_add->save();

          //return redirect()

    // $sp_new=Product::where('new',1)->get();
       return redirect()->with('thanhcong','Thêm sản phẩm mới thành công');
    }

}
