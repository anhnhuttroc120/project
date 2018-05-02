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
use Brian2694\Toastr\Facades\Toastr;
use App\Order;
use App\Order_detail;
use App\province;

class CartController extends Controller
{
    public function cart()
    {
        $provinces = DB::table('province')->pluck('name','provinceid')->all();
        $provinces['0'] ='-- Chọn tỉnh --';
        ksort($provinces);
        return view('default.pages.giohang', compact('provinces'));
    }

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
    			'options'=>['size'=>$request->size, 'color'=> $request->color, 'img'=>$image]
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

    public function checkout(Request $request)
    {       

        $carts = !empty(Cart::content()) ? Cart::content() : '';
        if(count($carts) <= 0){
            Toastr::warning('Không có sản phẩm nào trong giỏ hàng !,không thể đặt hàng ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
        } else {
            $data['phone'] = isset($request->phone) ? $request->phone : Auth::user()->phone;
            $data['address'] = isset($request->address) ? $request->address : Auth::user()->address;
            $data['users_id'] = Auth::user()->id;
            $data['quantity'] = Cart::count();
            $data['status'] = 2;
            $total =  str_replace(',','',Cart::subtotal());
            $data['total'] =  $total;
            $data['note'] = isset($request->note) ? $request->note : '';
            $dayTemp = time() + 172800;
            $data['date_shipper'] = date("Y-m-d", $dayTemp);
            $order = Order::create($data);
            foreach ($carts as $key => $item) {
                $data['quantity'] = $item->qty; 
                $data['order_id'] = $order->id; 
                $data['products_id'] = $item->id;
                $data['config'] = $item->options->size . '-' .$item->options->color;
                $data['total'] = str_replace(',','',$item->price * $item->qty);
                Order_detail::create($data);
            }
            Cart::destroy();
            return view('default.notice.giohang');
            }
    }
   
}
