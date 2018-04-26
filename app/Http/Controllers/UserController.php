<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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

	public function postDangNhap(Request $request){
		if($request->has('username')){
	 	    $data['username'] = $request->username;
	 		$data['password'] = $request->password; 
	 		if(Auth::attempt($data)){ //Auth atthemp  kiem tra du lieu nguoi dung co dung trong databse 
	 			return redirect()->intended('admin/index');
	 			
	 		} else {
	 			return back()->with('notice','Tài khoản và mật khẩu không chính xác');
	 		  }
	 	}

	}	
	 	
	public function logOut()
	{
		Auth::logout();
		return redirect()->route('login');
	}
 
}
