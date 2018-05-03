<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\ChangePassRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use Hash;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{	
	public function index()
	{
		return view('admin.index');
	}

	public function getDangNhap()
	{
		if(Auth::check()){
			return redirect('admin/index');
		}
		return view('admin.login');
	}

	public function postDangNhap(Request $request)
	{
		if($request->has('username')){
	 	    $data['username'] = $request->username;
	 		$data['password'] = $request->password; 
	 		if(Auth::attempt($data)){ //Auth atthemp  kiem tra du lieu nguoi dung co dung trong databse 
	 			return redirect()->intended('admin/index');
	 			
	 		} else {
	 			return back()->with('notice', 'Tài khoản và mật khẩu không chính xác');
	 		  }
	 	}

	}	
	 	
	public function logOut()
	{
		Auth::logout();
		return redirect()->route('login');
	}
	public function listUser()
	{
		$users = User::all();
		return view('admin.user.list', compact('users'));
	}

	public function getAdd()
	{
		return view('admin.user.add');
	}

	public function Add(AddUserRequest $request)

	{	
			
		$data          	 	= $request->all();
		$data['password']	= bcrypt($request->password);
		$data['status'] 	= 1;
		$data['created_by'] = Auth::user()->fullname;
		if($request->hasFile('picture')){
			$file 		= $request->file('picture');
			$name 		= $file->getClientOriginalName();
			$extension 	= $file->getClientOriginalExtension();
			if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' &&  $extension!= 'gif' ){
   				return redirect()->back()->with('notice', 'Kiểu ảnh không phù hợp');
   			}
   			$picture	 = str_random(6) .$name;
   			$file->move('images/user', $picture);
   			$img 		 = Image::make('images/user/' .$picture)->resize('50', '50');
   			$img->save('images/user/'.$picture);	
		} else {
			$picture	 = "";
			}
		$data['picture'] = $picture;	
		User::create($data);
		Toastr::success('Bạn đã thêm thành công', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
		return back();
		
	}

	public function Delete($id)
	{
		$user 		= User::findOrFail($id);
		$user->delete();
		if($user->picture !=''){
			$picture 	= $user->picture;
			if (file_exists('images/user/'.$picture)) {
			unlink('images/user/'.$picture);
			}

		}
		

	}

	public function getEdit($id)
	{
		$user = User::findOrFail($id);
		return view('admin.user.update', compact('user'));
	}

	public function Edit(EditUserRequest $request, $id)
	{
		$user 				= User::findOrFail($id);
		$data 				= $request->all();
		$data['status'] 	= 1;
		$data['crtead_by']	= Auth::user()->fullname;
		$oldImage 			= $user->picture;
	
		if($request->hasFile('picture')){ 

		   //ngươi dùng đã thay đổi file
			$file = $request->file('picture');
			echo '<pre>';
			print_r($file);
			echo '</pre>';
				
			$name = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();	
			if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg' &&  $extension != 'gif'){
   				return redirect()->back()->with('notice', 'Kiểu ảnh không phù hợp');
   			}
   			$newpicture = str_random(6).$name; // hibhf moi nguoi dung sua
   			$file->move('images/user',$newpicture);
   			$img 		= Image::make('images/user/'.$newpicture)->resize('50', '50');
   			$img->save('images/user/'.$newpicture);
   			if(file_exists('images/user/'.$oldImage)){
   				unlink('images/user/'.$oldImage);
   			}	
   			$data['picture'] = $newpicture;
		} else{ //  người dùng k thay đổi hình
			$data['picture'] = $oldImage;
			}

		
		$user->update($data);
		Toastr::success('Bạn đã sửa thành công người dùng có id là '. $user->id, 'Thông báo: ', ["positionClass" => "toast-top-right"]);
		return back();
	}
	public function profile()
	{
		return view('admin.user.profile');
	}
	public function changepass(ChangePassRequest $request)
	{
		 $user = User::where('username', $request->username)->first();
		 $data['password'] = bcrypt($request->password_new);
		 $user->update($data);
		 return back()->with('success', 'Bạn đã thay đổi mật khẩu thành công');

	}
 
}