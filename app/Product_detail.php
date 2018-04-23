<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
     protected $table='product_detail';
    
    protected $fillable=['size','color','picture_1','picture_2','picture_3','picture_4','picture_5','description','sale_off'];
    protected $lifestamp=true;

    public function product(){
    	return $this->hasOne('App\Product','product_detail_id','id');
    }
}
