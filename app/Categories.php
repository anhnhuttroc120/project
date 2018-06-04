<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'category';
    protected $fillable = ['name','slug','parent_id'];
    protected $lifestamp = true;
    public function products()
    {
    	return $this->hasMany('App\Product','category_id','id');
    }
    public function subcate()
    {
    	return $this->hasMany('App\Categories','parent_id','id');
    }
      public function category()
    {
    	return $this->belongsTo('App\Categories','parent_id','id');
    }

}
