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

            }
             return view('admin.product.list',compact(['products','category_id']));
        }
             

   }
   public function getAdd(){
   	$categories=Categories::pluck('name','id')->all();

    return view('admin.product.add');
   }

   public function Add(AddProductRequest $request){
   	               
      $color= isset($request->color) ? json_encode($request->color) :'';
   	  $size=	isset($request->size) ? json_encode($request->size) :'';
 

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
   				$name= $file->getClientOriginalName(); //lay tên ảnh gốc
   				$extension=$file->getClientOriginalExtension(); // lấy extion ảnh
   				if($extension !='jpg' && $extension!='png' && $extension!='jpeg' &&  $extension!='gif'){
   					return redirect()->back()->with('notice','Kiểu ảnh không phù hợp');
   				}
   				$picture=str_random(6).'_'.$name;
   			
   				$file->move('images/product',$picture);

   				$img= Image::make('images/product/'.$picture)->resize('286','381');
   				

   				$img->save('images/product/'.$picture);
   			

   				$data[$key]=$picture;
       
   			}
   			
   		 $data=json_encode($data);

   		 $product_detail->picture=$data;

   	}else{
   		$product_detail->picture='';
   	}
   	
    $product_detail->color= $color;
    $product_detail->size=$size;
   
    $product_detail->description=$request->description;
    $product_detail->sale_off=$request->sale_off;
    $product_detail->products_id=$product->id;
    $product_detail->save();
    return redirect()->back()->with('success','Đã  thêm sản phầm thành công');
 	
 	
 
   }
   public function getUpdate($id){
         
     $product=Product::find($id);
     if(empty($product->product_detail->size)){
        $product->product_detail->size=[];
     }
              

    return view('admin.product.update', compact('product'));      

   }
public function Update(Request $request,$id){
       $product=Product::find($id);
       $product->category_id=$request->category_id; 
       $product->name=$request->name;
       $product->price=$request->price;
       $product->slug=str_slug($request->name);
       $product->special=$request->special;
       $product->users_id=Auth::user()->id;
      
       $product_detail=Product_detail::where('products_id',$product->id)->first();
     
       $product_detail->description=$request->description;
       $product_detail->sale_off=$request->sale_off;
       $product_detail->products_id=$product->id;
      
       $product_detail->size=isset($request->size) ?json_encode($request->size):'';

      $product_detail->color=isset($request->color) ?json_encode($request->color):'';
       
      $oldImage=json_decode($product_detail->picture,true);
     
     
      $arrTemp=[1=>1,2=>2,3=>3,4=>4,5=>5]; // tạo mảng để so sánh mảng hình ảnh mới để truy xuất ra vị trí key của hình ảnh  không đc  sửa
     
   

      //Xử lý xóa ảnh, thêm ảnh trong database ,zoom ảnh , file upload
        if($request->hasFile('picture'))

        {

            $files=$request->file('picture');
           
          
           foreach ($files as $key => $file) {
              $name=$file->getClientOriginalName();
              $extension=$file->getClientOriginalExtension(); // lấy extision ảnh
           if($extension !='jpg' && $extension!='png' && $extension!='jpeg' &&  $extension!='gif'){
            return redirect()->back()->with('notice','Kiểu ảnh không phù hợp');
          }
            $picture=str_random(6).'_'.$name;
             $file->move('images/product',$picture);
             if(array_key_exists($key, $oldImage)){
              $url='images/product/'.$oldImage[$key];
               if(file_exists($url)){
                unlink($url);

               }

             }
         

             $img= Image::make('images/product/'.$picture)->resize('286','381');  //zoom ảnh
             $img->save();

              $listImage[$key]=$picture; //gắn tên ảnh mới zô mảng
             

           }

           foreach ($arrTemp as $key => $value) {
                if(!array_key_exists($key, $listImage))
                {
                  if(array_key_exists($key,$oldImage)){
                   $listImage[$key]=$oldImage[$key]; // hình cũ không  sửa, gắn lại vô mảng
                  }
                  
                }
           }
           $product_detail->picture=json_encode($listImage); // chuyển mảng thành jsson lưu vô ông nội database
     
              
        }
         $product_detail->save();
         return redirect()->back()->with('success','Bạn Đã thay đổi thành công sản phầm có mã số ID '.$product->id);



      
}
public function delete($id){
    $product=Product::findOrFail($id); //tim san phảm xóa
    $product_detail=Product_detail::where('products_id',$id)->first(); //tìm thong tin chi tiet san phẩm
    $product->delete(); //xóa sản phẩm
    if(!empty($product_detail->picture))//kiểm tra hình ảnh có tồn tại gắn vào mảng
    {  
        $pictures= json_decode($product_detail->picture);
    }
    
    if(!empty($pictures))
    {
      foreach ($pictures as $key => $picture) { //lặp mảng xóa
         if(file_exists('images/product/'.$picture))
         {
               unlink('images/product/'.$picture);
         }
        
    }
 
    }
    $product_detail->delete();
    
  


}



}