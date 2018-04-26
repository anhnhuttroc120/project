<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\AddUserRequest;
class UserController extends Controller
{	
	public function index(){
		return view('admin.index');
	}



	public function getDangNhap(){

	if(Auth::check()){
		return redirect('admin/index');
	}
		return view('admin.login');
	
		
	}
	public function postDangNhap(Request $request){
	
	
		if($request->has('username')){
	 		$data['username']=$request->username;
	 		$data['password']=$request->password; 
	 		
	 		if(Auth::attempt($data)){
	 			return redirect()->intended('admin/index');
	 			
	 		}else{
	 			return back()->with('notice','Tài khoản và mật khẩu không chính xác');
	 			
	 		}
	 	}

	}	
	 	
	
	public function logOut(){
		 Auth::logout();
		return  redirect()->route('login');
	}
	public function listUser(){
		$users = User::all();
		return view('admin.user.list',compact('users'));
	}
	public function getAdd(){
		return view('admin.user.add');
	}
	public function Add(AddUserRequest $request){


		$user = new User();
		$user->username= $request->username;
		$user->fullname= $request->fullname;
		$user->email= $request->email;
		$user->password= $request->password;
		$user->is_admin= $request->is_admin;
		$user->picture= $request->picture;
		$user->phone= $request->phone;
		$user->address= $request->address;
		$user->status= 1;
		$user->created_by = Auth::user()->fullname;
		// $user->save();
		// echo "OK";
		if($request->hasFile('picture')){
			$file=$request->file('picture');
			$name=$file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			if($extension !='jpg' && $extension!='png' && $extension!='jpeg' &&  $extension!='gif'){
   					return redirect()->back()->with('notice','Kiểu ảnh không phù hợp');
   				}
   			$picture = str_random(6).$name;
   			$file->move('images/user',$picture);
   			$img= Image::make('images/user/'.$picture)->resize('50','50');
   			$img->save('images/user/'.$picture);	

		}else{
			$picture="";
		}
		$user->picture=$picture;	
		$user->save();
		return back()->with('success','Thêm thành công');
	}
	public function Delete($id){
		$user = User::findOrFail($id);
		$user->delete();
		$picture = $user->picture;
		if (file_exists('images/user/'.$picture)) {
			unlink('images/user/'.$picture);
		}
	}
	public function getEdit($id){
		$user = User::findOrFail($id);

		return view('admin.user.update',compact('user'));
	}
	public function Edit(Request $request, $id){
		 $this->validate($request,[
          'username'=>'required|unique:users,username,'.$id.',id',
          'fullname'=>'required','email'=>'required|unique:users,email, '.$id.',id',
          'phone'=>'required',
          'address'=>'required'
        ]);

		$user = User::findOrFail($id);
		$user->username= $request->username;
		$user->fullname= $request->fullname;
		$user->email= $request->email;
		$user->is_admin= $request->is_admin;
		
		$user->phone= $request->phone;
		$user->address= $request->address;
		$user->status= 1;
		$user->created_by = Auth::user()->fullname;
		$oldImage=$user->picture;
		if($request->hasFile('picture')){    //ngươi dùng đã thay đổi file
			$file=$request->file('picture');
			$name=$file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			if($extension !='jpg' && $extension!='png' && $extension!='jpeg' &&  $extension!='gif'){
   					return redirect()->back()->with('notice','Kiểu ảnh không phù hợp');
   				}
   			$newpicture = str_random(6).$name; // hibhf moi nguoi dung sua
   			$file->move('images/user',$newpicture);
   			$img= Image::make('images/user/'.$newpicture)->resize('50','50');
   			$img->save('images/user/'.$newpicture);
   			
   			if(file_exists('images/user/'.$oldImage)){
   				unlink('images/user/'.$oldImage);
   			}	
   			$user->picture= $newpicture;

		}else{ //  người dùng k thay đổi hình
			$user->picture=$oldImage;
		}
		
		$user->save();
		return back()->with('success','Sửa thành công');
	}

}
