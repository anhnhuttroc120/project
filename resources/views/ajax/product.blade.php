              <table id="example1" class="table table-bordered table-striped">
                <thead style="background: #398ebd"  >
                <tr >
                  <th style="width: 13%;">Mã sản phẩm </th>
                  <th style="width: 13%;">Tên sản phẩm</th>
                  <th style="width: 13%;">Hình ảnh</th>
                  <th style="width: 13%;">Loại sản phẩm</th>
                  <th style="width: 5%;" >Giá</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                <tbody>
                 
               @foreach($products as $product)
                  <?php
                  $price=explode('.', $product->price);
                        if(!empty($product->detail->picture)){

                             $pictures=json_decode($product->detail->picture,true); //CHUYEN VE 1  mảng
                             $randomKey=array_rand($pictures,1); // lay ngẫynhieen key trong mảng pictures

                        }
            
                       
                       ?> 
                   
                <tr id="item-{{$product->id}}">
                  <td>{{$product->id}}</td>
                  <td>{{$product['name']}}</td>
                  <td> @if(!empty($pictures)) <img src="images/product/{{$pictures[$randomKey]}}" style="width: 50px;height: 50px;" alt="23">@else{!! '<span class="btn btn-warning">Chưa có ảnh</span>'!!} @endif</td>
                  <td>{{$product->category->name}} </td>
                  <td style="float: right;">{{number_format($price[0])}}đ</td>
                  <td style="width: 50px;" ><a  style="color: red";  href="javascript:deleteItem({{$product->id}})"><i class="fa fa-trash"></i></a>
                  <span style="font-weight: bold;margin-right: 5px;">|</span><a  style="color: green";  href="{{url('admin/product/updated/'.$product->id)}}"><i class="fa fa-edit"></i></a>  </td>
          
                </tr>
                  
                @endforeach  
         
  
                </tbody>
                <tfoot>
               
               </tfoot> 
                

               
              </table>
              {!!Form::close() !!}
               <div style="float:right" >
                    {!! $products->links() !!}
                    {{--  --}}

                </div>