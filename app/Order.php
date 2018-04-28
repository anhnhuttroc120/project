<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['quantity','status','total','users_id','address','phone','note'];
    protected $lifestamp = true;
    public function orders_detail()
    {
        return $this->hasMany('App\Order_detail','order_id','id');
    }

    public function user()
        {
        return $this->belongsTo('App\User','users_id','id');
    } 

    public function products()
    {
    	return $this->belongsToMany('App\Product','order_detail','order_id','products_id');
    }

}
