<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Product_detail;
use App\Product;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\AddProductRequest;
use Session;
class ProductController extends Controller
{
   public function index(){
   		$products=Product::paginate(4);
        

         return view('admin.product.list',compact(['products','category_id']));
	  		
	  	
	  
   }
   public function category($category_id){
   
       if(isset($category_id)){
       
         
             if($category_id=='default'){
                     $products=Product::paginate(1)->appends(request()->query());

          
           }else{
                   $products=Product::where('category_id',$category_id)->paginate(1)->appends(request()->query());;
   // ->appends(request()->query());
            }
            
     
              return view('admin.product.list',compact(['products','category_id']));
               }
             

   }
   public function getAdd(){
   	$categories=Categories::pluck('name','id')->all();

   return view('admin.product.add');
   }

   public function Add(Request $request){
   	        
                   
                     
   	 $color=	json_encode($request->color);
   	$size = json_encode($request->size);
     
      $product =new Product();
      $product->name=$request->name;
      $product->slug=str_slug($request->name);
      $product->price=$request->price;
      $product->users_id=Auth::user()->id;
      $product->category_id=$request->category_id;
      $product->special=$request->special;
      $product->save();

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
    $product_detail->products_id=$product->id;
    $product_detail->save();
    return redirect()->back()->with('success','Đã  thêm sản phầm thành công');
 	
 	
 
   }
   public function getUpdate($slug){
         
           $product=Product::where('slug',$slug)->first();
              

             return view('admin.product.update',compact('product'));      

   }
public function Update(Request $request,$slug){
      echo "<pre>";
      print_r($request->all());
      echo "</pre>";
}



}