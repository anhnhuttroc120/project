<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table    = 'comments';
    protected $fillable = ['email','name','content','parent_id','product_id'];
    protected $lifestamp = true;

    public function product(){
    	return $this->belongsTo('App\Product','product_id','id');
    }
}
