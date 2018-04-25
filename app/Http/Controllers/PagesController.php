<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;

use App\User;
use Session;
use Mail;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
  public function index(){
  	
  
  	return view('default.pages.trangchu');

  }
      public function getRegister(){
    	return view('default.pages.dangki');
    }
    public function postRegister(){


    		
    				$data=$request->all();
                    $data['status']=0;
                    $data['picture']='';
                    $data['is_admin']=0;
    				$data['created_by']='';
                    $email=$data['email'];
    				User::create($data);
    			return view('default.notice.resgiter',compact('email'))->with('success','Bạn đã đăng kí thành công, Vui lòng vào email xác nhận tài khoản');			
    }
    public function getDangNhap(){
    	return view('default.pages.dangnhap');
    }
     public function postDangNhap(Request $request){
     	$username=$request->username;
     	$password=$request->password;
     	if(Auth::attempt(['password'=>$password,'username'=>$username,'status'=>1])){
     		return redirect()->intended('trang-chu');
     	}else{
     		 return redirect()->back()->with('notice','Thông tin đăng nhập không chính xác! Hãy kiểm tra tài khoản và mật khẩu của bạn');
     	}
    	
    }
    public function logOut(){
    	 Auth::logout();
    	 return redirect()->back();
    }

}
