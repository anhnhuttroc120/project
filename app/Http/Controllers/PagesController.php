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
use App\province;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()

    {
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(12)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(12)->get();
        return view('default.pages.trangchu', compact('products'));
    }

    public function category($slug, $sort = 'asc')
    {   
        $category = Categories::where('slug', $slug)->first();
        $query  = Product::where('category_id', $category->id);
        $query->orderBy('price', $sort);
        if ($sort == 'bestseller') {
          $query->orderBy('bestseller','desc');  
        }
        $products = $query->paginate(8)->appends(request()->query());
        return view('default.pages.category', compact('products', 'category','sort'));
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
        }
     	return redirect()->back()->with('notice','Thông tin đăng nhập không chính xác! Hãy kiểm tra tài khoản và mật khẩu của bạn');	
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('trang-chu');
    }

    public function search(Request $request, $sort ='asc')
    {   
        if($request->has('keyword')){
            $keyword = $request->keyword;
            $query = Product::whereHas('category', function($query) use ($keyword) {
                $query->where('name','like',"%".$keyword . "%")->orWhere('slug','like',"%".$keyword."%");
                 })->orwhere('name', 'like', "%".$keyword . "%");
            if($sort == 'bestseller'){ 
                $query->orderBy('bestseller', 'desc');
            }
            $query->orderBy('price', $sort);
            $products = $query->paginate(4)->appends(request()->query());
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
    public function district(Request $request)
    { 
        $city = $request->idCity;
        $result = ''; 
        $province = province::where('provinceid',$city)->first();
        if ($city != 00) {
            foreach ($province->district as $key => $district) {
                $result .= '<option  value="'.$district->districtid.'">'.$district->name.'</option>';
            }
        } 
        return $result;

          
         
    }
}
