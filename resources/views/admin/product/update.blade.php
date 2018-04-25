@extends('layout.admin.master')
@section('css')

@endsection
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sản phẩm
        <small>Thêm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Sản phẩm</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          <div>
       
            
       @if (Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      @endif

            @if($errors->any())
       <div class="alert alert-danger">
        <ul style="list-style-type: none">
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
       
    </div>
        @endif

          </div>
          
       
      {!! Form::model($product,['url' => 'admin/product/updated/'.$product->id, 'method' => 'patch','files'=>true]) !!}
      <?php
           if(!empty($product->product_detail->color)){
             $colors=json_decode($product->product_detail->color);
           }else{
             $colors=[];  

           }

        
         if(!empty($product->product_detail->size)){
            $sizes=json_decode($product->product_detail->size);
         }else{
            $sizes=[];
         
           
         } 
          
          $pictures=json_decode($product->product_detail->picture,true);

            
               
           ?>
              <div class="box-body">
           <div class="form-group">
  {!! Form::label('name', 'Tến sản phẩm') !!}
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
      

     {!! Form::label('name', 'Trắng') !!}

     
      @if(in_array('Trắng',$colors))
        <input type="checkbox" name="color[]" value="Trắng" checked>
       @else
        <input type="checkbox" name="color[]" value="Trắng">
            
        @endif    
 
   
     {!! Form::label('name', 'Đen') !!}
     
     @if(in_array('Đen',$colors))
        <input type="checkbox" name="color[]" value="Đen" checked>
       @else
        <input type="checkbox" name="color[]" value="Đen">
         
     
        @endif    

     {!! Form::label('name', 'Hồng') !!}
  
  
  @if(in_array('Hồng',$colors))
       
        <input type="checkbox" name="color[]" value="Hồng" checked>
       @else
        <input type="checkbox" name="color[]" value="Hồng">
         
  

        @endif    
   

  
     {!! Form::label('name', 'Xanh') !!}

  @if(in_array('Xanh',$colors))
       
            <input type="checkbox" name="color[]" value="Xanh" checked>
       @else
        <input type="checkbox" name="color[]" value="Xanh">
       
    
        @endif    
  

  
     {!! Form::label('name', 'Tím') !!}
     
     
        @if(in_array('Tím',$colors))
                 <input type="checkbox" name="color[]" value="Tím" checked>
       @else
        <input type="checkbox" name="color[]" value="Tím">
      

        @endif    


  </div>
</div>
<div class="form-group">
  {!! Form::label('name', 'Giảm giá') !!}
  <div class="form-controls">
    {!! Form::text('sale_off', $product->product_detail->sale_off, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
  {!! Form::label('name', 'Kích thước') !!}
  <div class="form-controls">
      {!! Form::label('name', 'Size S') !!}
   
    @if(in_array('S',$sizes))

    {!! Form::checkbox('size[]', 'S',true) !!}
    @else
    {!! Form::checkbox('size[]', 'S') !!}
    @endif


  {!! Form::label('name', 'Size M') !!}
 
       @if(in_array('M',$sizes))

    {!! Form::checkbox('size[]', 'M',true) !!}
    @else
    {!! Form::checkbox('size[]', 'M') !!}
    @endif
  
      {!! Form::label('name', 'Size L') !!}
       
     @if(in_array('L',$sizes))

    {!! Form::checkbox('size[]', 'L',true) !!}
    @else
    {!! Form::checkbox('size[]', 'L') !!}
    @endif
  
  
      {!! Form::label('name', 'Size XL') !!}
    @if(in_array('XL',$sizes))

    {!! Form::checkbox('size[]', 'XL',true) !!}
    @else
    {!! Form::checkbox('size[]', 'XL') !!}
    @endif

 
  </div>
   <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="description" id="demo" class="form-control ckeditor" rows="3" value="{{$product->product_detail->description}}">{{$product->product_detail->description}}</textarea>
                </div>


    @if (Session::has('notice'))
        <div class="alert alert-danger">
          {{ Session::get('notice') }}
        </div>
      @endif 
     
   <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 1</label>
      <input type="file" id="exampleInputFile" name="picture[1]">
      @if(isset($pictures[1]))
      <img src="images/product/{{$pictures[1]}}" alt="">
      
      
      @endif
      
  </div>

  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 2</label>
      <input type="file" id="exampleInputFile" name="picture[2]">
       @if(isset($pictures[2]))
      <img src="images/product/{{$pictures[2]}}" alt="">
      
      
      @endif

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 3</label>
      <input type="file" id="exampleInputFile" name="picture[3]">
     @if(isset($pictures[3]))
      <img src="images/product/{{$pictures[3]}}" alt="">
      
      
      @endif

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 4</label>
      <input type="file" id="exampleInputFile" name="picture[4]">
@if(isset($pictures[4]))
      <img src="images/product/{{$pictures[4]}}" alt="">
      
      
      @endif
      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 5</label>
      <input type="file" id="exampleInputFile" name="picture[5]">
    @if(isset($pictures[5]))
      <img src="images/product/{{$pictures[5]}}" alt="">
      
      
      @endif
      
  </div>
 
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Thay đổi thông tin</button>
              </div>
            {!! Form::close() !!}
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
         

       
         

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
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
<script src="ckeditor/ckeditor.js"></script>
@endsection