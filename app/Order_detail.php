<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    
    protected $table='order_detail';
    
    protected $fillable=['quantity','order_id','products_id','total'];
    protected $lifestamp=false;
    public function order(){
    	return $this->belongsTo('App\Order','order_id','id');
    }
    public function product(){
    	return $this->hasOne('App\Product','id','products_id');

    }
}
