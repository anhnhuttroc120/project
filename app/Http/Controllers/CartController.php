<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Session;
use App\Product;
// use DB;
use App\Categories;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;
use App\Order;
use App\Order_detail;
use App\province;
use App\district;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart()
    {
        $provinces = province::pluck('name','provinceid')->all();
        $provinces['0'] ='-- Chọn tỉnh --';
        ksort($provinces);
        $user = Auth::user();
        return view('default.pages.giohang', compact('provinces', 'user'));
    }

    public function add(Request $request)
    {   
        if ($request->ajax()) {
            $product = Product::find($request->id);
            $images = isset($product->detail->picture) ? json_decode($product->detail->picture,true) : '' ;
            $image = $images[1];
            if ($product->detail->sale_off > 0 ) {
            $price = ((100 - $product->detail->sale_off)*$product->price)/100;
            } else {
            $price = $product->price;
            }         
            $infoProduct = [
                'id' =>$product->id,
                'name'=>$product->name,
                'price'=>$price,
                'qty' =>$request->quantity,
                'options'=>['size'=>$request->size, 'color'=> $request->color, 'img'=>$image]
            ];
            Cart::add($infoProduct);
            $cartCount = Cart::count();
            $header = view('ajax.header')->render();
            return response()->json(['header'=>$header, 'count'=>$cartCount], 200);          
            }
    }

    public function update(Request $request)
    {
    	if ($request->ajax()) {
            if ($request->type == 'up') {
    		  $cartUpdate = Cart::update($request->rowId, $request->qty+1);
            } else {
             $cartUpdate = Cart::update($request->rowId, $request->qty-1);   
            }
            $header = view('ajax.header')->render();
            $view = view('ajax.giohang')->render();
            $cartCount = Cart::count();
            return response()->json(['view'=>$view, 'header'=>$header, 'count'=>$cartCount], 200);

    	}

    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            Cart::remove($request->rowId);
            $header = view('ajax.header')->render();
            $view = view('ajax.giohang')->render();
            $cartCount = Cart::count();
            return response()->json(['view'=>$view, 'header'=>$header, 'count'=>$cartCount], 200);
        }

    }

    public function checkout(Request $request)
    {       
        try{
            DB::beginTransaction();  
            $carts = !empty(Cart::content()) ? Cart::content() : '';
            if (count($carts) <= 0) {
                Toastr::warning('Không có sản phẩm nào trong giỏ hàng !,không thể đặt hàng ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
                return back();
            } else {
                $address = '';
                $cityAndDistrict = '';
                if ($request->has('city') && $request->city != '0') {
                    $award = district::where('districtid', $request->district)->first();
                    $city = $award->province->name;
                    $cityAndDistrict = $award->name .' ' . $city;
                }
                $data['phone'] = isset($request->phone) ? $request->phone : Auth::user()->phone;
                $data['address'] = isset($request->address) ? $request->address.' '.$cityAndDistrict : Auth::user()->address.' '.$cityAndDistrict;
                $data['users_id'] = Auth::user()->id;
                $data['quantity'] = Cart::count();
                $data['status'] = 2;
                $total =  str_replace(',', '', Cart::subtotal());
                $data['total'] =  $total;
                $data['note'] = isset($request->note) ? $request->note : '';
                $dayTemp = time() + 172800; //mặc địnhk thời gian giao hàng sau khi check out là 2 ngày 
                $data['date_shipper'] = date("Y-m-d", $dayTemp);
                $order = Order::create($data);
                foreach ($carts as $key => $item) {
                    $order->products()->attach($item->id, ['quantity'=>$item->qty, 'config'=> $item->options->size . '-' .$item->options->color, 'total'=>str_replace(',', '', $item->price * $item->qty)]);
                }
                Cart::destroy();
                DB::commit();
                $URL = url('order');
                $success = 'Bạn đã đặt hàng thànhx công vui lòng đợi 1-2 ngày để giao hàng ! .Click vào <a href="'.$URL.'"> đây </a> để xem thông tin đơn hàng vừa đặt';
                return back()->with('success', $success);
            }
        } catch(\Exception $e) {
            DB::rollBack();
            Toastr::warning('Vui lòng đăng nhập trước khi đặt hàng nha chế !'.$e->getMessage(), 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
        }     
    } 
}
