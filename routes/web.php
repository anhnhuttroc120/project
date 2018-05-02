<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




		
Route::get('mail',function(){
	     

		// $data = ['nam','nho'];

  //                   Mail::send('email.dangki',$data,function($message){
  //                           $message->from('namdosatdn@gmail.com');
  //                           $message->to('boyquay_timgirlnhinhanh_dn2006@yahoo.com.vn','conan Vu')->subject('Xac nhan email');
  //                   });
  //                   echo 'da gui mail thanh cong';

});


   //customer side
Route::get('giohang','CartController@cart')->name('gio-hang');
Route::get('district','PagesController@district');
Route::get('dang-ki','PagesConTroller@getRegister');
Route::post('dang-ki','PagesConTroller@postRegister');
Route::get('dang-nhap','PagesConTroller@getDangNhap')->name('login');
Route::post('dang-nhap','PagesConTroller@postDangNhap');
Route::get('trang-chu','PagesController@index');
Route::get('dang-xuat','PagesController@logOut');
Route::get('category/{slug}','PagesController@category');
Route::get('category/{slug}/{sort}','PagesController@order');
Auth::routes();
Route::get('search','PagesController@search');
Route::get('search/{keyword}/{sort}','PagesController@orderSearch');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('chi-tiet/{slug}','PagesController@detail');
Route::post('add-cart/','CartController@add');
Route::post('update-cart','CartController@update');
Route::get('delete-cart/{rowId}','CartController@delete');
Route::post('check-out','CartController@checkout')->middleware('checkLogin');
Route::get('check-out',function(){
	return view('default.pages.404');
});


//admin side

Route::get('admin/dang-nhap','UserController@getDangNhap')->name('login');
Route::post('admin/dang-nhap','UserController@postDangNhap');
Route::get('admin/dang-xuat', 'UserController@logOut');
Route::get('admin/profile','UserController@profile');
Route::post('admin/changePass','UserController@changePass');
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
	Route::get('index','UserController@index');
	Route::group(['prefix'=>'product'], function(){
		Route::get('add','ProductController@getAdd');
		Route::post('add','ProductController@Add')->name('add');
		Route::get('list','ProductController@index');
		Route::get('updated/{slug}','ProductController@getUpdate');
		Route::get('category/{id}','ProductController@category');
		Route::patch('updated/{id}','ProductController@Update');
		Route::get('delete/{id}','ProductController@delete');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('list','UserController@listUser');
		Route::get('add','UserController@getAdd');
		Route::post('add','UserController@Add');
		Route::get('delete/{id}','UserController@Delete');
		Route::get('edit/{id}','UserController@getEdit');
		Route::put('edit/{id}','UserController@Edit');
	});
	Route::group(['prefix'=>'order'],function(){
		Route::get('list','OrderController@list');
		Route::get('detail/{id}','OrderController@detail');
		Route::post('change-status/{id}','OrderController@changeStatus');
		Route::get('search','OrderController@Search');
		Route::get('date','OrderController@Date');
		Route::get('status/{id}','OrderController@Status');
	});



});
// Route::get('/trang-chu','ProductController@trangchu');
//them
		
