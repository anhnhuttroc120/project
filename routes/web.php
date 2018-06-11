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




		


   //customer side
Route::get('test','UserController@email');
Route::get('giohang','CartController@cart')->name('gio-hang')->middleware('checkLogin');
Route::get('district','PagesController@district');
Route::get('dang-ki','PagesConTroller@getRegister');
Route::post('dang-ki','PagesConTroller@postRegister');
Route::get('dang-nhap','PagesConTroller@getDangNhap');
Route::post('dang-nhap','PagesConTroller@postDangNhap');
Route::get('trang-chu','PagesController@index');
Route::get('/','PagesController@index');
Route::get('dang-xuat','PagesController@logOut');
Route::get('category/{slug}','PagesController@category');
Auth::routes();
Route::get('search','PagesController@search')->name('search');
// Route::get('search/{keyword}/{order}','PagesController@search');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('chi-tiet/{slug}','PagesController@detail');
Route::post('add-cart/','CartController@add')->name('add-cart');

Route::post('update-cart','CartController@update')->name('update-cart');
Route::get('delete-cart/','CartController@delete')->name('delete-cart');

Route::post('check-out','CartController@checkout')->middleware('checkLogin');

Route::post('comment','ProductController@postComment')->name('comment');
Route::get('profile','PagesController@profile')->middleware('auth');;
Route::post('profile/{id}','PagesController@postprofile')->middleware('auth');
Route::get('order','PagesController@order');
Route::get('status','PagesController@status');
Route::get('changepass','PagesController@changePass');
Route::get('pdf/{id}','OrderController@getPDF')->name('getPDF');

Route::post('changepass','PagesController@postchangepass');

Route::get('detail/{id}','PagesController@infoOrder')->middleware('checkLogin');
Route::get('forgetPass','PagesController@getForgetPassword');
Route::get('autocomplete','PagesController@autocomplete');




//admin side

Route::get('admin/dang-nhap','UserController@getDangNhap')->name('login');
Route::post('admin/dang-nhap','UserController@postDangNhap');
Route::get('admin/dang-xuat', 'UserController@logOut');
Route::get('admin/profile','UserController@profile');
Route::post('admin/changePass','UserController@changePass');
Route::group(['prefix'=>'admin','middleware'=>'checkLogin'], function(){
	Route::group(['middleware'=>'auth'], function(){
		Route::get('chart','OrderController@chart');
		Route::get('calendar','OrderController@calendar');
		Route::get('index','UserController@index');
		Route::group(['prefix'=>'product'], function(){
			Route::get('add','ProductController@getAdd');
			Route::post('add','ProductController@Add')->name('add');
			Route::get('list','ProductController@index')->name('product');
			Route::get('updated/{slug}','ProductController@getUpdate');
			Route::get('category/{id}','ProductController@category');
			Route::patch('updated/{id}','ProductController@Update');
			Route::get('delete/{id}','ProductController@delete');
		});
		Route::group(['prefix'=>'user'],function(){
			Route::get('list','UserController@listUser')->name('index');
			Route::get('add','UserController@getAdd');
			Route::post('add','UserController@Add');
			Route::get('delete/{id}','UserController@Delete');
			Route::get('edit/{id}','UserController@getEdit');
			Route::put('edit/{id}','UserController@Edit');
		});
		Route::group(['prefix'=>'order'],function(){
			Route::get('list','OrderController@list')->name('order');
			Route::get('detail/{id}','OrderController@detail');
			Route::post('change-status/{id}','OrderController@changeStatus');
			Route::get('search','OrderController@Search');
			Route::get('date','OrderController@Date');
			Route::get('status/{id}','OrderController@Status');
			Route::post('print','OrderController@exportExcel');
		});
	});	

});

