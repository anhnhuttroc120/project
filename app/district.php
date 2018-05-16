<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $table = 'district';
    protected $fillable = ['districtid','name','type','provinceid'];
    public function province()
    {
    	return $this->belongsTo('App\province','provinceid','provinceid');
    }
}
