<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Categories;
use App\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Validator;
use Hash;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        if(\Schema::hasTable('category')){
            $categories = Categories::pluck('name','id')->all();
            $categories['default']= '--Tất cả loại sản phẩm --'  ;
            $categories_main = Categories::all();
            ksort($categories);
            View::share('categories', $categories);
            View::share('categories_main', $categories_main);
        }
        $special = ['Không','Có'];
        View::share('special', $special);
        $role = ['Member','Admin'];
        View::share('role', $role);
        $arrStatus = [1=>'Đã xử lý', 2=>'Đang xử lý', 3=>'Hủy'];
        View::share('arrStatus', $arrStatus);
        if(\Schema::hasTable('order')){
            $data['done']=  Order::where('status', 1)->count();
            $data['waiting'] = Order::where('status', 2)->count();
            $data['cancel'] = Order::where('status', 3)->count();
             View::share('data', $data);
        }
        $sorts = ['asc'=>'Sắp xếp theo giá : Từ thấp đến cao','desc'=>'Sắp xếp theo giá : Từ cao đến thấp','bestseller'=>'Sắp xếp theo giá : bán chạy nhất'];
        View::share('sorts', $sorts);
        Validator::extend('password_old',function($attribute,$value,$parameters,$validator){
            return Hash::check($value,current($parameters));
       });
        $quantitys = range(1,50);
        View::share('quantitys', $quantitys);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
