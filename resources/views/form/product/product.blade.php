<div class="form-group">
  {!! Form::label('name', 'Tến sản phẩm') !!}
  <div class="form-controls">
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
  </div>
</div>



<div class="form-group">

      <label for="exampleInputUserName">Loại sản phẩm</label>

   {!! Form::select('category', $categories, null, ['class' => 'form-control']) !!}
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
	  {!! Form::checkbox('color[]', 'Trắng') !!}
	    {!! Form::label('name', 'Đen') !!}
	  {!! Form::checkbox('color[]', 'Đen') !!}
	    {!! Form::label('name', 'Hồng') !!}
	  {!! Form::checkbox('color[]', 'Hồng') !!}
	    {!! Form::label('name', 'Xanh') !!}
	  {!! Form::checkbox('color[]', 'Xanh') !!}
	   {!! Form::label('name', 'Tím') !!}
	  {!! Form::checkbox('color[]', 'Tím') !!}
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
                    <textarea name="des" id="demo" class="form-control ckeditor" rows="3"></textarea>
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
 