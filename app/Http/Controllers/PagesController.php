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
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Validator;
use Illuminate\Support\MessageBag;
class PagesController extends Controller
{
    public function index()
    {
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(12)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(12)->get();
        return view('default.pages.trangchu', compact('products'));
    }

    public function category(Request $request, $slug)
    {   
        $sort = ($request->has('sort')) ? $request->sort :'asc';
        $category = Categories::where('slug', $slug)->first();
        $query  = Product::whereHas('category', function($querysub) use ($slug){
            $querysub->where('slug', $slug);
        });
        if ($sort == 'bestseller') {
          $query->orderBy('bestseller', 'desc');  
        }
        $query->orderBy('price', $sort);
        $products = $query->paginate(8)->appends(request()->query());
        return view('default.pages.category', compact('products', 'category', 'sort'));
    }

    public function getRegister()
    {
        return view('default.pages.dangki');
    }
    
    public function postRegister(Request $request)
    {		
        if ($request->ajax()) {
            $rules = [
            'email' =>'unique:users,email',
            'username' => 'unique:users,username'
            ];
            $messages = [
               'email.unique' => 'Email đã tồn tại',
                'username.unique' => 'Tên tài khoản đã tồn tại',         
            ];
            $data = $request->all();
            $data['status'] = 1;
            $data['password'] = bcrypt($request->password);
            $data['is_admin'] = 0;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                    return response()->json([
                            'error' => true,
                            'messages' => $validator->errors(), 
                        ], 200);
                    
            }     
            User::create($data); // them vo database
            Toastr::success('Bạn vừa đăng kí thành công ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return response()->json(['error'=>false]);
        }     			
    } 

    public function getDangNhap()
    {
        return view('default.pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        if ($request->ajax()) {
             $username = $request->username;
             $password = $request->password;
            if (Auth::attempt(['password' => $password, 'username'=>$username])){
                return response()->json(['status'=>'success'],200);
            }
                return response()->json(['status'=>'fail'],200);


        }
       
     		
       
    }

    public function logOut()
    {
        Auth::logout();
        Cart::destroy();
        return redirect('trang-chu');
    }

    public function search(Request $request)
    {   
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $query = Product::whereHas('category', function($query) use ($keyword) {
                $query->where('name','like',"%".$keyword . "%")->orWhere('slug','like',"%".$keyword."%");
                 })->orwhere('name', 'like', "%".$keyword . "%");
        }
        $sort = ($request->has('sort')) ? $request->sort :'asc';
        if ($sort == 'bestseller') { 
            $query->orderBy('bestseller', 'desc');
        }
        $query->orderBy('price', $sort);
        if ($request->ajax()) {
            $position = $request->position;
            $item =$request->item;
            $products =  $query->offset($position)->limit($item)->get();
            $view = view('ajax.search', compact('products'))->render();
            return response()->json(['view'=>$view], 200);    
        }
        $products = $query->paginate(8);
        return view('default.pages.timkiem', compact('keyword', 'products','sort'));   
    }    

    public function autocomplete(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->keyword;
            $products = Product::where('name', 'like' , "%". $keyword . "%")
                ->orwhereHas('category',function($query) use ($keyword){
                      $query->where('name', 'like', "%".$keyword . "%");
                })->limit(5)->get();
            $products = view('ajax.autocomplete', compact('products'))->render();
            return response()->json(['products'=>$products], 200);     
        
        }
    }

    public function detail($slug)
    {
        $product_main = Product::where('slug', $slug)->first();
        $products['relate'] = Product::where('category_id', $product_main->category->id)->inRandomOrder()->take(3)->get();
        $products['bestseller'] = Product::orderBy('bestseller', 'desc')->take(4)->get();
        $products['new'] = Product::orderBy('id', 'desc')->take(4)->get();
        return view('default.pages.chitiet', compact('product_main', 'products'));
    }
    public function district(Request $request)
    { 
        $city = $request->idCity;
        $result = ''; 
        $province = province::where('provinceid', $city)->first();
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
    public function postprofile(EditUserRequest $request, $id)
    {
        $user = User::where('username', $request->username)->first();
        $data = $request->all();
        $oldImage           = ($user->picture =='') ? ' ' : $user->picture;
        if ($request->hasFile('picture')) { 
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
        Toastr::success('Bạn vừa cập nhập thành công thông tin tài khoản ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
        return back();    
    }
    public function order()
    {
        //$user = User::find(Auth::user()->id);
        //dd($users);
        $user = Order::where('users_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(7);
        //dd($user);
         return view('default.pages.order.list',compact('user')); 
    }

    public function status(Request $request) 
    {
        if($request->ajax()) {
            $id = $request->id;
            $order = Order::findOrFail($id);
            $data['status'] = ($request->status == 3) ? 2 : 3;
            $order->update($data);
            $view = view('ajax.orderclient', compact('order'))->render();
            return response()->json(['view'=>$view, 'id'=>$order->id], 200);
        }
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
