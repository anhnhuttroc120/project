<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    static $DONE = 1;
    static $PENDING = 2;
    static  $CANCEL = 3;
    protected $table = 'order';
    protected $fillable = ['quantity','status','total','users_id','address','phone','note','date_shipper'];
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
    	return $this->belongsToMany('App\Product','order_detail','order_id','products_id')->withTimestamps();
    }
    public static function statusHTML()
    {
        return [
        self::$DONE => sprintf('<small style="line-height:25px;"  class="label label-success">Đang xử lý</small>'),
        self::$PENDING => sprintf('<small style="line-height:25px;"  class="label label-default">Đã xử lý</small>'),
        self::$CANCEL => sprintf('<small style="line-height:25px;"  class="label label-danger">Hủy</small>'),
        ];
    }
}
