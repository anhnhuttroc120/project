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
          
       
      {!! Form::model($product,['url' => 'admin/product/add', 'method' => 'post','files'=>true]) !!}
      <?php
          $colors=json_decode($product->product_detail->color);
               
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

   <?php
              echo "<pre>";
              print_r($colors);
              echo "</pre>";

         ?>
 

  {!! Form::label('name', 'Màu sắc') !!}
  <div class="form-controls">
      

     {!! Form::label('name', 'Trắng') !!}

     @foreach($colors as $color)
      @if($color=='Trắng')
        <input type="checkbox" name="color[]" value="Trắng" checked>
       @elseif($color=='Trắng' && !in_array('Trắng',$colors))
        <input type="checkbox" name="color[]" value="Trắng">
            
        @endif    
     @endforeach
  

      

   
     {!! Form::label('name', 'Đen') !!}
      @foreach($colors as $color)
      @if($color=='Đen')
        <input type="checkbox" name="color[]" value="Đen" checked>
       @elseif($color ='Đen' &&   !in_array('Đen',$colors))
        <input type="checkbox" name="color[]" value="Đen">
         
     
        @endif    
     @endforeach
  
    


     {!! Form::label('name', 'Hồng') !!}
  
    
     @foreach($colors as $color)
      @if($color=='Hồng')
       
        <input type="checkbox" name="color[]" value="Hồng" checked>
       @elseif($color !='Hồng' || in_array('Hồng',$colors))
        <input type="checkbox" name="color[]" value="Hồng">
         
    

        @endif    
     @endforeach

  
     {!! Form::label('name', 'Xanh') !!}

     @foreach($colors as $color)
      @if($color=='Xanh')
       
            <input type="checkbox" name="color[]" value="Xanh" checked>
       @elseif($color !='Xanh' || in_array('Hồng',$colors))
        <input type="checkbox" name="color[]" value="Xanh">
       
    

        @endif    
     @endforeach



  

  
     {!! Form::label('name', 'Tím') !!}
      @foreach($colors as $color)
      @if($color=='Tím')
       
                 <input type="checkbox" name="color[]" value="Tím" checked>
       @elseif($color !='Tím' || in_array('Hồng',$colors))
        <input type="checkbox" name="color[]" value="Tím">
      

        @endif    
     @endforeach

   
   


  </div>
</div>
<div class="form-group">
  {!! Form::label('name', 'Giảm giá') !!}
  <div class="form-controls">
    {!! Form::text('sale_off', null, ['class' => 'form-control']) !!}
  </div>
  <div class="form-group">
  {!! Form::label('name', 'Kích thước') !!}
  <div class="form-controls">
      {!! Form::label('name', 'Size S') !!}
    {!! Form::checkbox('size[]', 'S') !!}
      {!! Form::label('name', 'Size M') !!}
    {!! Form::checkbox('size[]', 'M') !!}
      {!! Form::label('name', 'Size L') !!}
    {!! Form::checkbox('size[]', 'L') !!}
      {!! Form::label('name', 'Size XL') !!}
    {!! Form::checkbox('size[]', 'XL') !!}
  </div>
   <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="description" id="demo" class="form-control ckeditor" rows="3"></textarea>
                </div>


    @if (Session::has('notice'))
        <div class="alert alert-danger">
          {{ Session::get('notice') }}
        </div>
      @endif 
   <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 1</label>
      <input type="file" id="exampleInputFile" name="picture[]">

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 2</label>
      <input type="file" id="exampleInputFile" name="picture[]">

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 3</label>
      <input type="file" id="exampleInputFile" name="picture[]">

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 4</label>
      <input type="file" id="exampleInputFile" name="picture[]">

      
  </div>
  <div class="form-group">
      <label for="exampleInputFile">Hình ảnh 5</label>
      <input type="file" id="exampleInputFile" name="picture[]">

      
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