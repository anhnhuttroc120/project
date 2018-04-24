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


// Route::get('category','PagesController@category');
// Route::get('timkiem','PagesController@timkiem');
// Route::get('chitiet',function(){
// 	return view('default.pages.chitiet');
// });


// Route::get('dangnhap',function(){
// 		return view('default.pages.dangnhap');
// });
// Route::get('giohang',function(){
// 		return view('default.pages.giohang');
// });
// Route::get('error',function(){
// 		return view('default.pages.404');
// });


// Route::get('/',function(){
// 	return view('admin.index');
// });
// Route::get('table',function(){
// 	return view('admin.user.list');
// });
// Route::get('add',function(){
// 	return view('admin.user.add');
// });
// Route::get('login',function(){
// 	return view('admin.login');
// });




   //customer side


Route::get('dang-ki','PagesConTroller@getRegister');
Route::post('dang-ki','PagesConTroller@postRegister');
Route::get('dang-nhap','PagesConTroller@getDangNhap');
Route::post('dang-nhap','PagesConTroller@postDangNhap');
Route::get('trang-chu','PagesController@index');
Route::get('dang-xuat','PagesController@logOut');

                



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//admin side


Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'product'],function(){

		Route::get('add','ProductController@getAdd');
		Route::post('add','ProductController@Add')->name('add');
		rOUTE::get('list','ProductController@index');

	});




});
// /ahihihii