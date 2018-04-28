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

Route::get('admin/dang-nhap','UserController@getDangNhap')->name('login');
Route::post('admin/dang-nhap','UserController@postDangNhap');
Route::get('admin/dang-xuat', 'UserController@logOut');
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
		
