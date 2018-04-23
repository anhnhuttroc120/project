<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Product_detail;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
   public function index(){
   		$products=Product_detail::all()->toArray();
	  		foreach ($products as $key => $product) {
	  				$pictures=json_decode($product['picture']);
	  				$colors=json_decode($product['color']);
	  				$sizes=json_decode($product['size']);

	  		
	  		}
	  		
	  	
	  
   }
   public function getAdd(){
   	$categories=Categories::pluck('name','id')->all();

   return view('admin.product.add');
   }

   public function Add(Request $request){
   	
  	
   	$color=	json_encode($request->color);
   	$size = json_encode($request->size);
  
   	$product_detail=new Product_detail();
   	if($request->hasFile('picture')){
   		$data=[];
   			
   		$files=$request->file('picture');
   		
   			foreach ($files as $key => $file) {
   				$name= $file->getClientOriginalName();
   				$extension=$file->getClientOriginalExtension();
   				if($extension !='jpg' && $extension!='png' && $extension!='jpeg' &&  $extension!='gif'){
   					return redirect()->back()->with('notice','Kiểu ảnh không phù hợp');
   				}
   				$picture=str_random(6).'_'.$name;
   			
   				$file->move('images/product',$picture);

   				$img= Image::make('images/product/'.$picture)->resize('286','381');
   				

   				$img->save('images/product/'.$picture);
   			

   				$data[]=$picture;
   			
   			}
   			
   			 
   				
   		 $data=json_encode($data);
   		 $product_detail->picture=$data;

   	}else{
   		$product_detail->picture='';
   	}
   	
   $product_detail->color=$color;
    $product_detail->size=$size;
   
   $product_detail->description=$request->description;
    $product_detail->sale_off=$request->sale_off;
    $product_detail->products_id=$request->id;
    $product_detail->save();
 	
 	
 
   }
}