@extends('default.master')
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="css/dung.css">
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
	select{
		font-family: fontAwesome;
	}
</style>

@endsection
@section('content')

	<div class="container-fluid" style="margin-top: -19px; ">
		<div class="row">
				@include('default.pages.order.sidebar')
				    {!! Toastr::message() !!}
			
			<div style="" class="col-md-8">
				<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>ĐƠN HÀNG CHI TIẾT</a>
					</div>
					<h6 style="font-size: 21px;">Mã số đơn hàng : {{$order->id}}</h6>
					<table class="table table-bordered">
							<thead>
							<tr >
								<th class="text-center">Tên sản phẩm</th>
								<th>Hình</th>
								<th class="text-center">Size-Color</th>
								<th class="text-center">Số lượng</th>
								<th class="text-center">Giá tiền</th>					
													
							</tr>
							</thead>
							<tbody>
							@foreach($order->orders_detail as $order_detail)
							<?php 
							$pictures =  json_decode($order_detail->product->detail->picture,true);
							$picture = $pictures[1];
								
							?>

							<tr class="">
								
								<td style="lin" class="center">{{$order_detail->product->name}}</td>
								<td class="center" ><img  style="width: 50px;height: 50px;" src="images/product/{{$picture}}" alt="" ></td>
								<td class="center">{{$order_detail->config}}</td>
								<td class="center">{{$order_detail->quantity}}</td>
								<td class="center">{{number_format($order_detail->total)}} VND</td>
							
							</tr>
							@endforeach
							</tbody>
							<tfoot>
			                  <td  colspan="4" class="text-right" ;" >Tổng tiền:</td>
			                  <td colspan="1" ><span style="color: red;padding-left: 15px;">{{number_format($order->total)}}<sup>đ</sup></span></td>
			                </tfoot>
						</table>
						<a href="{{url('pdf/' .$order->id)}}" class="print" > <i style="color: black;" class="fa fa-print"></i>In hóa đơn</a>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection