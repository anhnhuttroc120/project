<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Intervention\Image\ImageManagerStatic as Image;

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
		return back()->with('success', 'Thêm thành công');
	}

	public function Delete($id)
	{
		$user 		= User::findOrFail($id);
		$user->delete();
		$picture 	= $user->picture;
		if (file_exists('images/user/'.$picture)) {
			unlink('images/user/'.$picture);
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
		if($request->hasFile('picture')){    //ngươi dùng đã thay đổi file
			$file = $request->file('picture');
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
   			$user->picture = $newpicture;
		} else{ //  người dùng k thay đổi hình
			$user->picture = $oldImage;
			}
		
		$user->update($data);
		return back()->with('success','Sửa thành công');
	}
 
}
