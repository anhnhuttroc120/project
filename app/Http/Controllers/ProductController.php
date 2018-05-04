<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categories;
use App\Product_detail;
use App\Product;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Session;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
class ProductController extends Controller
{
    public function index()
   {
   		$products = Product::paginate(4);       
      return view('admin.product.list', compact(['products', 'category_id']));
   }

    public function category($category_id)
   {
        if (isset($category_id)) {
            if ($category_id == 'default') {      
                $products = Product::paginate(4)->appends(request()->query());
                 return view('admin.product.list',compact(['products',   'category_id']));
            } else {
                $products = Product::where('category_id', $category_id)->paginate(4)->appends(request()->query());// apppend dùng để giữ tham số trên thanh URL khi kick zô nút phân trang ko bị mất 
                return view('admin.product.list', compact(['products' , 'category_id']));
            }
        }
     
    }

    public function getAdd()
    {
        return view('admin.product.add');
    }

    public function Add(AddProductRequest $request)
    {   
        try{
            DB::beginTransaction();
            $data               = $request->all();
            $data['slug']       = str_slug($request->name);
            $data['users_id']   = Auth::user()->id;
            $data['bestseller'] = rand(1,5555);
            $product = Product::create($data);   
            if ($request->hasFile('picture')) {
                $dataImage=[];
                $files=$request->file('picture');
                foreach ($files as $key => $file) {
                   $name        = $file->getClientOriginalName(); //lay tên ảnh gốc
                   $extension   = $file->getClientOriginalExtension(); // lấy extion ảnh
                    $picture = str_random(6).'_'.$name;             
                    $file->move('images/product',$picture);
                    $img     = Image::make('images/product/'.$picture)->resize('286', '381');
                    $img->save('images/product/'.$picture);
                    $dataImage[$key] = $picture;
                }       
                $dataImage = json_encode($dataImage);
                $data['picture'] = $dataImage;
            } else {
                $data['picture'] = '';
                }
            $colors               = isset($request->color) ? json_encode($request->color) :'';
            $sizes                = isset($request->size) ? json_encode($request->size) :'';   
            $data['color']        = $colors;
            $data['size']         = $sizes;
            $data['products_id']  = $product->id; 
            Product_detail::create($data); 
            Toastr::success('Bạn đã  thêm thành công sản phẩm mới ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            DB::commit();
            return back();
        } catch(\Exception $e){
            DB::rollBack();
            Toastr::warning('Đã xảy ra lỗi '. $e->getMessage(), 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
        }          
        
    }

    public function getUpdate($id)
    { 
        $product = Product::findOrFail($id);
        return view('admin.product.update', compact('product'));      
    }

    public function Update(EditProductRequest $request, $id)
    {   
        try{
            DB::beginTransaction();
            $product  = Product::find($id);
            $data = $request->all();
            $data['slug'] = str_slug($request->name);
            $data['users_id'] = Auth::user()->id;
            $product->update($data);    
            $data['products_id'] = $product->id;
            $data['size']   = isset($request->size) ? json_encode($request->size):'';
            $data['color']  = isset($request->color) ? json_encode($request->color):'';
            $oldImage = json_decode($product->detail->picture, true);
            $arrTemp = [1=>1,2,3,4,5]; // tạo mảng để so sánh mảng hình ảnh mới để truy xuất ra vị trí key của hình ảnh  không đc  sửa
         
          //Xử lý xóa ảnh, ,zoom ảnh ,  upload ảnh
            if ($request->hasFile('picture')) {  
                $files=$request->file('picture');
                foreach ($files as $key => $file) {
                    $name=$file->getClientOriginalName();
                    $picture=str_random(6).'_'.$name;
                    $file->move('images/product',$picture);
                    if (array_key_exists($key, $oldImage)) {
                    $url='images/product/'.$oldImage[$key];
                        if (file_exists($url)) {
                            unlink($url);
                        }
                    }
                    $img = Image::make('images/product/'.$picture)->resize('286', '381');  //zoom ảnh
                    $img->save();
                    $listImage[$key] = $picture; //gắn tên ảnh mới zô mảng
                }
                foreach ($arrTemp as $key => $value) {
                    if(!array_key_exists($key, $listImage)){
                        if(array_key_exists($key, $oldImage)){
                       $listImage[$key] = $oldImage[$key]; // tên hình cũ không  sửa, gắn lại vô mảng
                        }     
                    }
                }
                $data['picture'] = json_encode($listImage); // chuyển mảng thành json lưu vô ông nội database   
            }
            $product->detail->update($data);
            Toastr::success('Bạn đã sửa thành công sản phẩm mã số ID ' .$product->id, 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            DB::commit();
            return back();

        }catch(\Exception $e){
            DB::rollBack();
            Toastr::warning('Đã xảy ra lỗi không thể thay đổi  ', 'Thông báo: ', ["positionClass" => "toast-top-right"]);
            return back();
        }
        
    }   
    public function delete($id)
    {
        $product = Product::findOrFail($id); //tim san phảm xóa //tìm thong tin chi tiet san phẩm //xóa sản phẩm
        if(!empty($product->detail->picture)){ //kiểm tra hình ảnh có tồn tại gắn vào mảng
            $pictures = json_decode($product->detail->picture);
        }
        if(!empty($pictures)){
            foreach ($pictures as $key => $picture){ //lặp mảng xóa trong thư mục upload file
                if(file_exists('images/product/'.$picture)){
                     unlink('images/product/'.$picture);
                }     
            }
         }
        $product->delete();
        $product->detail->delete();
        return response(['success'=>'OK'],200);
    }   

}
