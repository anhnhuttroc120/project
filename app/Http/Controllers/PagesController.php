<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\User;
use Session;
use Mail;
use App\Product;
use App\Comment;
use DB;
use App\Categories;
use App\province;
use App\Order;

use App\Http\Requests\ChangePassRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

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
        $data = $request->all();            
        $data['status'] = 1;
        $data['password'] = bcrypt($request->password);

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

        return view('default.notice.resgiter')->with('success', 'Bạn đã đăng kí thành công');			
    } 

    public function getDangNhap()
    {
        return view('default.pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['password' => $password, 'username'=>$username])){
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
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query1 = Product::whereHas('category', function($query) use ($keyword) {
                $query->where('name','like',"%".$keyword . "%")->orWhere('slug','like',"%".$keyword."%");
                 })->orwhere('name', 'like', "%".$keyword . "%");
            if ($sort == 'bestseller') { 
                $query1->orderBy('bestseller', 'desc');
            }
            $query1->orderBy('price', $sort);
            $products = $query1->paginate(4)->appends(request()->query());
            return view('default.pages.timkiem', compact('keyword', 'products','sort'));

        }
    }    

    public function detail($slug)
    {
        $product_main = Product::where('slug', $slug)->first();
        // $comments = Comment::where('product_id',$product_main->id)->get();  
        $products['relate'] = Product::where('category_id', $product_main->category->id)->inRandomOrder()->take(3)->get();
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(4)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(4)->get();
        return view('default.pages.chitiet', compact('product_main', 'products'));
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
    
    public function profile()
    {
        return view('default.pages.order.profile');
    }
    public function postprofile(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $data = $request->all();
        $oldImage           = ($user->picture =='') ? ' ' : $user->picture;
        if ($request->hasFile('picture')) { 
                echo 'co hinh';
           //ngươi dùng đã thay đổi file
            $file = $request->file('picture');
            $name = $file->getClientOriginalName();
            $newpicture = str_random(6).$name; // hibhf moi nguoi dung sua
            $file->move('images/user',$newpicture);
            $img        = Image::make('images/user/'.$newpicture)->resize('50', '50');
            $img->save('images/user/'.$newpicture);
            if(file_exists('images/user/'.$oldImage)){
                unlink('images/user/'.$oldImage);
            }   
            $data['picture'] = $newpicture;
        } else { //  người dùng k thay đổi hình
            $data['picture'] = $oldImage;
        }
   
        $user-> update($data);
        return back();

        
    }
    public function order()
    {
        //$user = User::find(Auth::user()->id);
        //dd($users);
        $user = Order::where('users_id','=',Auth::user()->id)->paginate(7);
        //dd($user);
         return view('default.pages.order.list',compact('user')); 
    }

    public function status($status,$id) 
    {
        $order = Order::findOrFail($id);
        if ($status == 3) {
             $data['status'] = 2;
        } else {
            $data['status'] = 3;
        }
        $order->update($data);
       return back();
    
    }

    public function infoOrder($id)
    {
        $order = Order::findOrFail($id);
        //dd($order);
       return view('default.pages.order.detail',compact('order'));
    }

    public function changePass()
    {
        return view('default.pages.order.pass'); 
    }
    public function postchangepass(ChangePassRequest $request)
    {
      $use = User::where('username', $request->username)->first();
      $data['password'] = bcrypt($request->password_new);
      $use-> update($data);
      return back()->with('success','Bạn đã thay đổi mật khẩu thành công');
    }

    public function getForgetPassword()
    {
        return view('auth.passwords.email');
    }


}
