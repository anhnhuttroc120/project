<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
     protected $table='product_detail';
    
    protected $fillable=['size','color','picture','description','sale_off','products_id'];
    protected $lifestamp=true;

    public function product(){
    	return $this->belongsTo('App\Product','products_id','id');
    }
}
