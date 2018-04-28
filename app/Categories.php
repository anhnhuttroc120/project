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

}
