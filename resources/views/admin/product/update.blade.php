@extends('layout.admin.master')
@section('css')
<link rel="stylesheet" href="css/addproduct.css">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

@endsection
@section('content')
<?php 

           if(!empty($product->detail->color)){
             $colors=json_decode($product->detail->color,true);
           }else{
             $colors=[];  

           }

        
         if(!empty($product->detail->size)){
            $sizes=json_decode($product->detail->size,true);
         }else{
            $sizes=[];
         
           
         } 
          
          $pictures=json_decode($product->detail->picture,true);

            
               
           ?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sửa Sản Phẩm
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/index')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active"><a href="{{url('admin/product/list')}}">Sản Phẩm</a></li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <!-- left column -->

       {!! Toastr::message() !!}

               @if($errors->any())
             <div class="alert alert-danger">
              <ul style="list-style-type: none">
                  @foreach ($errors->all() as $error)
                      <li >{{ $error }}</li>
                  @endforeach
              </ul>
             
            </div>{{-- ALERT --}}
               @endif
  <div class="col-md-6">
          <!-- general form elements -->
   {!! Form::model($product,['url' => 'admin/product/updated/'.$product->id, 'method' => 'patch','files'=>true]) !!}
   <div class="form-group">
        {!! Form::label('name', 'Tên sản phẩm') !!}
        <div class="form-controls">
          {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
  </div>
      
  <div class="form-group">
        <label for="exampleInputUserName">Loại sản phẩm</label>

     {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
   </div>
<div class="form-group">
    {!! Form::label('name', 'Giá sản phẩm') !!}
    <div class="form-controls">
      {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>

</div>

<div class="form-group">
  {!! Form::label('name', 'Sản phẩm đặc biệt') !!}
  <div class="form-controls">
    {!! Form::select('special',$special, null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Màu sắc') !!}


    <div class="form-controls">  
  @foreach($Arrcolors as $key =>$color)
       {!! Form::label('name', $color) !!}
       @if(!empty($colors[$key]) && in_array($colors[$key] ,$Arrcolors))
          <input type="checkbox" name="color[{{$key}}]" value="{{$color}}" checked >
       @else
        <input type="checkbox" name="color[{{$key}}]" value="{{$color}}" >
       @endif       
         
          
  @endforeach

    </div>
</div>

<div class="form-group">
  {!! Form::label('name', 'Giảm giá') !!}
  <div class="form-controls">
    {!! Form::text('sale_off', $product->detail->sale_off, ['class' => 'form-control']) !!}
  </div>
 </div> 


 <div class="form-group">
  {!! Form::label('name', 'Kích thước') !!}
  <div class="form-controls">
     
    @foreach($ArrSize as $key =>$size)
     {!! Form::label('name', $size) !!}
  
       @if(!empty($sizes[$key]) && in_array($sizes[$key] ,$ArrSize))
          <input type="checkbox" name="size[{{$key}}]" value="{{$size}}" checked >
       @else
        <input type="checkbox" name="size[{{$key}}]" value="{{$size}}" >
       @endif  
  @endforeach

    </div>
 </div>

  <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="description" id="demo" class="form-control ckeditor" rows="3" value="{{$product->detail->description}}">{{$product->detail->description}}</textarea>
       </div>



  
</div> {{-- col-md-6 --}}
          
       
  <div class="col-md-6 right">
    <label for="exampleInputFile">Hình ảnh </label>
  <div class="wraper-picture" style="width: 90%;border: 1px dashed black;padding: 10px;">
      
      <input type="hidden" name="imageDelete"  value="">
      @forelse($pictures as $key => $picture)
      <span class="item">
        <img style="width: 100px;height: 100px;margin-top:10px;position: relative !important;"  src="images/product/{{$picture}}" alt="" data-id="{{$key}}">
        <a style="left: -12px;top:-40px;cursor: pointer;display: none" class="btn-danger glyphicon glyphicon-remove delete"></a>
      </span>
      @empty
      
      @endforelse
     <div class="empty" style="display: none"></div>
      
  </div>
   <div class="form-group">
      <label for="exampleInputFile">Thêm hình ảnh</label>
      <input type="file" style="display:none" id="upload-input" multiple="multiple" name="picture[]" accept="image/*" class="dropzone">
                                <div id="upload" class="form-control drop-area" style="height: 350px;">
                                    <h3 ">Kéo & thả ảnh vào đây ! </h3>
                                    <button type="button" class="btn btn-primary btn-sm " id="btn_select"> Click vào đây để chọn ảnh !</button>
                                    <div  id="thumbnail" ></div>
                                </div>

      
  </div>
 
  

   <button style="margin-left: 250px;" type="submit" class="btn btn-primary">Thay đổi thông tin</button>
  </div> {{-- col-md-6 right --}}
    {!! Form::close() !!}      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div> {{-- wraper --}}
@endsection
@section('script')
<!-- jQuery 3 -->
<script src="AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="AdminLTE-2.4.3/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE-2.4.3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminLTE-2.4.3/dist/js/demo.js"></script>
<script src="http://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
 <script>
  $(document).ready(function(){
     jQuery(function($){
            var fileDiv = document.getElementById("upload");
            var fileInput = document.getElementById("upload-input");
            var btnSelect = document.getElementById('btn_select');
            fileInput.addEventListener("change",function(e){
                var files = this.files
                console.log(files);
                showThumbnail(files)
            },false)

            btnSelect.addEventListener("click",function(e){
                $(fileInput).show().focus().click().hide();
                e.preventDefault();
            },false)


            fileDiv.addEventListener("dragenter",function(e){
                e.stopPropagation();
                e.preventDefault();
            },false);


            fileDiv.addEventListener("dragover",function(e){
                e.stopPropagation();
                e.preventDefault();
            },false);

            fileDiv.addEventListener("drop",function(e){
                e.stopPropagation();
                e.preventDefault();
                var dt = e.dataTransfer;
                var files = dt.files;
                console.log(files);
                fileInput.files = files;
                showThumbnail(files)
            },false);

            function showThumbnail(files){
                $('.box-image').remove();
                for(var i=0;i<files.length;i++){
                    var file = files[i]

                    var container = document.createElement('div');
                    container.classList.add('box-image');

                    var image = document.createElement("img");
                    image.classList.add("img-thumbnail");
                    image.file = file;
                    container.appendChild(image);

                    var thumbnail = document.getElementById("thumbnail");
                    thumbnail.appendChild(container);

                    var reader = new FileReader()
                    reader.onload = (function(aImg){
                        return function(e){
                            aImg.src = e.target.result;
                        };
                    }(image))
                    var ret = reader.readAsDataURL(file);
                    var canvas = document.createElement("canvas");
                    ctx = canvas.getContext("2d");
                    image.onload= function(){
                        ctx.drawImage(image,50,50)
                    }
                }
            };
        });
  });
</script>
<script>
  $(document).ready(function(){
    $('.wraper-picture img').mouseover(function(){
      $(this).parent('span.item').find('a').show();

    });
    //   $('div.wraper-picture img').mouseleave(function(){
    //   $(this).parent('span.item').find('a').hide();

    // });
    // $('.wrapper-picture a').mouseover(function(){
    //   $(this).show();
    // });
    var item = $('span.item');
    if (item.length <= 0) {
        $('.empty').show().html('<h1>Không có ảnh nào đc thêm vào </h1>')
    } else {
      $('.empty').hide();
    }
    var arrTemp = [];
   $('a.delete').click(function(){
    $(this).parent('span.item').remove();
    var dataId = $(this).parent('span.item').find('img').attr('data-id');
    arrTemp.push(dataId);
    var test = $('input[name=imageDelete]').val(arrTemp);
    

   });
  });  


</script>

@endsection