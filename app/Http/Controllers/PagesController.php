<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\User;
use Session;
use Mail;
use App\Product;
use DB;
use App\Categories;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()

    {
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(12)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(12)->get();
        return view('default.pages.trangchu', compact('products'));
    }

    public function category($slug)
    {   
        $category = Categories::where('slug', $slug)->first();
        $products = Product::where('category_id', $category->id)->orderBy('price', 'asc')->paginate(4)->appends(request()->query());;
        return view('default.pages.category', compact('products', 'category'));
    }

    public function order($slug,$sort)
    {       
        $category = Categories::where('slug', $slug)->first(); 
        if($sort != 'bestseller'){
            $products = Product::where('category_id', $category->id)->orderBy('price', $sort)->paginate(4)->appends(request()->query());

        } else {
            $products = Product::where('category_id', $category->id)->orderBy('bestseller', 'desc')->paginate(4)->appends(request()->query());
            }
        return view('default.pages.category', compact('products', 'category', 'sort'));  
    }


    public function getRegister()
    {
        return view('default.pages.dangki');
    }

    public function postRegister(CreateRequest $request)
    {				
        $data=$request->all();            
        $data['status'] = 0;
        $data['picture'] = '';
        $data['is_admin'] = 0;
        $data['created_by'] = '';
        // $data['maActive'] = csrf_token(); 
        User::create($data); // them vo database
	
                   
                    // Mail::send('email.dangki',$data,function($message){
                    //         $message->from('namdosatdn@gmail.com');
                    //         $message->to('boyquay_timgirlnhinhanh_dn2006@yahoo.com.vn','conan Vu')->subject('Xac nhan email');
                    // });
                    // echo 'da gui mail thanh cong';

        return view('default.notice.resgiter')->with('success', 'Bạn đã đăng kí thành công, Vui lòng vào email xác nhận tài khoản');			
    } 

    public function getDangNhap()
    {
        return view('default.pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if(Auth::attempt(['password' => $password, 'username'=>$username, 'status'=>1])){
            return redirect()->intended('trang-chu');
        } else {
     		 return redirect()->back()->with('notice','Thông tin đăng nhập không chính xác! Hãy kiểm tra tài khoản và mật khẩu của bạn');
     	  }
    	
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        if($request->has('keyword')){
            $keyword = $request->keyword;
            if($keyword != ''){ 
               $products = DB::table('products')->join('category','products.category_id','=','category.id')->join('product_detail','products.id','=','product_detail.products_id')->where('products.id',$keyword)->orWhere('products.name','like',"%".$keyword."%")->orWhere('category.slug','like',"%".$keyword."%")->orWhere('category.name','like',"%".$keyword."%")->orderBy('price','asc')->select('products.*','category.name as name_category','product_detail.*')->paginate(4)->appends(request()->query());

               return view('default.pages.timkiem', compact('keyword', 'products'));
            } else {
                return view('default.pages.404');
                }  
         
        } 
           
    }

    public function orderSearch($keyword,$sort)

    {    
        if(!empty($sort)){
            $keyword = $keyword;
            if($sort !='bestseller'){
                $products = DB::table('products')->join('category','products.category_id','=','category.id')->join('product_detail','products.id','=','product_detail.products_id')->where('products.id',$keyword)->orWhere('products.name','like',"%".$keyword."%")->orWhere('category.slug','like',"%".$keyword."%")->orWhere('category.name','like',"%".$keyword."%")->select('products.*','category.name as name_category','product_detail.*')->orderBy('price',$sort)->paginate(4)->appends(request()->query());
            } else {

                 $products = DB::table('products')->join('category' ,'products.category_id', '=' ,'category.id')->join('product_detail', 'products.id', '=', 'product_detail.products_id')->where('products.id', $keyword)->orWhere('products.name','like',"%".$keyword."%")->orWhere('category.slug','like',"%".$keyword."%")->orWhere('category.name','like', "%".$keyword."%")->select('products.*','category.name as name_category','product_detail.*')->orderBy('bestseller','desc')->paginate(4)->appends(request()->query());
                }   

           return view('default.pages.timkiem', compact('keyword', 'products','sort'));
        }
      

    }
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $products['relate'] = Product::where('category_id', $product->category->id)->inRandomOrder()->take(3)->get();
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(4)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(4)->get();
        return view('default.pages.chitiet', compact('product', 'products'));
    }

}
