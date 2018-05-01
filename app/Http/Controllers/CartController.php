<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use App\Product;
use DB;
use App\Categories;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    public function add(Request $request)
    {
    	if($request->has('id')){
    		$product = Product::find($request->id);
    		$images = isset($product->detail->picture) ? json_decode($product->detail->picture,true) : '' ;
    		$image = $images[1];
    		if($product->detail->sale_off > 0 ){
			$price = ((100 - $product->detail->sale_off)*$product->price)/100;
			} else {
			$price =$product->price;
				}
    		$infoProduct = [
    			'id' =>$product->id,
    			'name'=>$product->name,
    			'price'=>$price,
    			'qty' =>$request->quantity,
    			'options'=>['size'=>$request->size,'color'=>$request->color,'img'=>$image]

    		];

    		Cart::add($infoProduct);
    		return redirect()->route('gio-hang');

    	}
    	
    }
    public function update(Request $request)
    {
    	if(!empty($request->rowId)){

    		$cart_update = Cart::update($request->rowId, $request->qty);

    		return response(['cart_one'=>$cart_update,'total'=>Cart::subtotal(),'count'=>Cart::count()], 200);
    	}

    }
    public function delete($rowId)
    {
    	if(!empty($rowId)){
    		Cart::remove($rowId);
    		return back();
    	}
    }
}
