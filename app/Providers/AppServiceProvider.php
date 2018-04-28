<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Categories;
use App\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
            $categories=Categories::pluck('name','id')->all();
            $categories['default']='--Chọn lọai sản phẩm--'  ;
            ksort($categories);
            View::share('categories', $categories);
        
        }
        $special=['Không','Có'];
        View::share('special', $special);
        $role=['Member','Admin'];
        View::share('role', $role);
        $arrStatus=['Đang xử lý','Đã xử lý','Hủy'];
        View::share('arrStatus', $arrStatus);
        if(\Schema::hasTable('order')){

            $data['done']=Order::where('status', 1)->count();
            $data['waiting']=Order::where('status', 3)->count();
            $data['cancel']=Order::where('status', 2)->count();
             View::share('data', $data);
        }

           // $colorD=['default'=>'Chọn màu','Đỏ','Tím','Hồng','Xanh','Đen','Trắng'];
           // ksort($color);
           // View::share('color', $color);
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
