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
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Mail;

class UserController extends Controller
{	
	public function index()
	{
		return view('admin.index');
	}
	
	public function listUser(Request $request)
	{
		$query = User::query();
		if ($request->has('keyword') && !empty($request->keyword)) {
			$keyword = $request->keyword;
			$query->where('fullname','like',"%".$keyword."%")->orWhere('email','like',"%".$keyword."%")->orWhere('username','like',"%".$keyword."%");
		}
		if ($request->has('role')) {
			$role = $request->role;
			if ($role !='default'){
				$query->where('is_admin', $role);
			}
		}
		if ($request->ajax()) {
			$users = $query->paginate(4)->appends(['keyword'=>$request->keyword, 'role'=>$request->role]);	
		 	$view = view('ajax.user', compact('users'))->render();
			return response()->json(['view'=>$view], 200);
		}
		$users = $query->paginate(4)->appends(request()->query());
		return view('admin.user.list', compact('users', 'keyword', 'role'));
	}			
		
	public function email()
	{
 			$data = [1,2];
            Mail::send('email.dangki',$data,function($message){
                    $message->from('namdosatdn@gmail.com');
                    $message->to('huonghien191fighting@gmail.com','conan Vu')->subject('Xac nhan email');
            });
            echo 'da gui mail thanh cong';

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

	public function getAdd()
	{
		return view('admin.user.add');
	}

	public function Add(AddUserRequest $request)

	{	
		try{
			DB::beginTransaction();
			$data = $request->all();
			$data['password']=bcrypt($request->password);
			$data['status'] = 0;
			$data['created_by'] = Auth::user()->fullname;
			if ($request->hasFile('picture')) {
				$file 		= $request->file('picture'); //lay dc file
				$name 		= $file->getClientOriginalName();//lay dc ten hinh
	   			$picture	 = str_random(6) .$name;
	   			$file->move('images/user', $picture);  // luu o thu muc public/images/user/tenfile
	   			$img 		 = Image::make('images/user/' .$picture)->resize('50', '50');
	   			$img->save('images/user/'.$picture);	
			} else {
				$picture	 = "";
			}
			$data['picture'] = $picture;
			User::create($data);
			Toastr::success('Bạn đã thêm thành công', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			DB::commit();
			return back();		
		} catch (\Exception $e) {
			DB::rollBack();
			Toastr::warning('Đã xảy ra lỗi', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			return back();
		}		
	}

	public function Delete($id)
	{
		$user = User::findOrFail($id);
		if (count($user->orders) > 0 ){
			Toastr::warning('Người dùng này không thể xóa', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			return  response()->json(['status'=>'error'], 200);
		}
		$user->delete();
		if($user->picture !=''){
			$picture 	= $user->picture;
			if (file_exists('images/user/'.$picture)) {
			unlink('images/user/'.$picture);
			}
		}
		return  response()->json(['status'=>'success'], 200);

	}

	public function getEdit($id)
	{
		$user = User::findOrFail($id);
		if( $user->is_admin == 1 && Auth::user()->id != $id || Auth::user()->is_admin == 0 && $user->is_admin == 1  || Auth::user()->is_admin==0 && Auth::user()->id != $id ) {
			Toastr::warning('Không đủ chức quyền để cập nhật !', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			return back();
		}
		return view('admin.user.update', compact('user','id'));
	}
	private function notAccess($listAdmin)
	{		
		
		
	}

	public function Edit(EditUserRequest $request, $id)
	{	
		try{
			DB::beginTransaction();
			$user 				= User::findOrFail($id);
			$data 				= $request->all();
			$data['status'] 	= 1;
			$data['crtead_by']	= Auth::user()->fullname;
			$oldImage 			= ($user->picture =='') ? ' ' : $user->picture;
			if ($request->hasFile('picture')) { 
			   //ngươi dùng đã thay đổi file
				$file = $request->file('picture');
				$name = $file->getClientOriginalName();
	   			$newpicture = str_random(6).$name; // hibhf moi nguoi dung sua
	   			$file->move('images/user',$newpicture);
	   			$img 		= Image::make('images/user/'.$newpicture)->resize('50', '50');
	   			$img->save('images/user/'.$newpicture);
	   			if(file_exists('images/user/'.$oldImage)){
	   				unlink('images/user/'.$oldImage);
	   			}	
	   			$data['picture'] = $newpicture;
			} else { //  người dùng k thay đổi hình
				$data['picture'] = $oldImage;
			}
			$user->update($data);
			Toastr::success('Bạn đã sửa thành công người dùng có id là '. $user->id, 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			DB::commit();
			return back();
		} catch(\Exception $e) {
			DB::rollBack();
			Toastr::warning('Đã có lỗi xảy ra ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
			return back();	
		}
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

	public function data($keyword)
	{
		$user = User::where('username','like', '%'.$keyword.'%')->paginate(4)->appends(request()->query());
	}
	
}