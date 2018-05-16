<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table = 'province';
    protected $fillable = ['provinceid','name','type'];
    public function district()
    {
    	return $this->hasMany('App\district','provinceid','provinceid');
    }
}
