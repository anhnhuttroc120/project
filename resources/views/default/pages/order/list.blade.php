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
			
			<div style="" class="col-md-8">
				<div style="margin-bottom: 20px;">
					<a style="border-bottom: 3px solid #FF0000;font-size: 20px;font-weight: bold; "><i class="fa fa-shopping-cart fa-2x" style="color: black"> </i>SẢN PHẨM ĐÃ CHỌN</a>
					</div>
						<table class="table table-bordered">
							<thead>
							<tr >
								<th class="text-center">Mã đơn hàng</th>
								<th class="text-center">Khách hàng</th>
								<th class="text-center">Số lượng</th>
								<th class="text-center">Thành tiền</th>
								<th class="text-center">Trạng thái</th>
								<th class="text-center">Ngày đặt hàng</th>
								<th class="text-center">Chi tiết</th>
								
							</tr>
							</thead>
							<tbody>
								@foreach($user as $or)
								<?php 
									$result = '';
									if($or->status == 3) {
										$link = url('order/'.$or->status.'/'.$or->id);
										$result = '<a href="'.$link.'" style=""><small style=" width:150px !important;" class="label label-danger"> Hủy</small></a>';
									}elseif($or->status == 2) {
										$link = url('order/'.$or->status . '/'.$or->id);
										$result = '<a href="'.$link.'" style=""><small style=" width:150px !important;" class="label label-default">  Đang xử lý</small></a>';
									}else{

										 $result = '<small style=" width:150px !important;" class="label label-success" > Đã xử lý</small>';
									}
									$timestamp = strtotime($or->created_at);
									$date = date('d-m-Y', $timestamp);
									

									
								 ?>
							<tr class="">
								<input type="hidden" id="">
								<td class="center" ><img src="" alt="" >{{$or->id}}</td>
								<td class="center">{{$or->user->fullname}}</td>
								<td class="center">{{$or->quantity}}</td>
								<td class="center">{{number_format($or->total)}} VND</td>
								<td style="padding-left: 20px; width: 15%;">{!! $result !!}</td>
								<td class="center">{{$date}}</td>
								<td class="center"><a href="{{url('detail/'.$or->id)}}"><i style="color: red;" class=" fa fa-info-circle"></i></a></td>
							</tr>
							@endforeach
							</tbody>
						</table>
					<div style="float:right">
						{!! $user->render() !!}
					</div>	
			</div>
		</div>

	</div>
@endsection
@section('script')
@endsection