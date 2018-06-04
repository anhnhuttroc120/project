@extends('layout.admin.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="css/addproduct.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('content')

<?php


 ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Thêm 
        <small>Sản phẩm</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active"><a href="{{url('admin/product/list')}}">Sản phẩm</a></li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
        {!! Toastr::message() !!}

      <div class="row">

        @if($errors->any())
           <div style="margin-left: 10px;width: 700px;" class="alert alert-danger">
            <ul style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li >{{ $error }}</li>
                @endforeach
            </ul>
           
           </div>
        @endif
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->

           {!! Form::open(['url' => 'admin/product/add', 'method' => 'post','files'=>true]) !!}
              <div class="box-body">
             @include('form.product.product')
              </div>
           
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
              </div>
           

          </div>

          <!-- /.box -->

          <!-- Form Element sizes -->
         

       

  <div class="col-md-6" style="margin-top:10px;">
      <div class="form-group">
         <div class="form-group">
                    <label>Nội Dung</label>
                    <textarea name="description"  class="form-control ckeditor" >
                      {{old('description')}}
                    </textarea>
        </div>
      
      </div>

  </div> {{-- col-md-6 --}}
   {!! Form::close() !!}
        </div>
            <!-- /.row -->
        <!--/.col (left) -->
        <!-- right column -->
        

  
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
  CKEDITOR.replace('description', {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            });

</script>
          


@endsection