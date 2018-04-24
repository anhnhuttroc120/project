<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Categories;
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
           // $color=['default'=>'Chọn màu','Đỏ','Tím','Hồng','Xanh','Đen','Trắng'];
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
