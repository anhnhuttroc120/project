<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table    = 'products';
    protected $fillable = ['name','slug','price','special','product_detail_id','users_id','category_id'];
    protected $lifestamp = false;

    public function category()
    {
    	return $this->belongsTo('App\Categories', 'category_id', 'id');
    }

    public function detail()
    {
    	return $this->hasOne('App\Product_detail','products_id', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User',' users_id', 'id');
    }

    public function order_detail()
    {
    	return $this->hasMany('App\Order_detail', 'order_id', 'id');

    }
    public function order()
    {
        return $this->belongsToMany('App\Order', 'order_detail', 'order_id', 'products_id');
    }
}
