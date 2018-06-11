@forelse($products as $product)	
<?php 
	$pictures = json_decode($product->detail->picture,true);
	$picture_main = reset($pictures);
	if($product->detail->sale_off > 0){
	$price = ((100 - $product->detail->sale_off)*$product->price)/100;
	} else {
	$price = $product->price;
	}

?>
	<tr class="item">
	    <td> <a href="chi-tiet/{{$product->slug}}"><img src="images/product/{{$picture_main}}" alt=""></a></td>
	    <td>
	        <a href="chi-tiet/{{$product->slug}}">
	           {{$product->name}}
	            <p class="price-search">{{number_format($price)}}<span><sup>đ</sup></span></p>
	        </a>
	    </td>
	</tr>
@empty
<tr class="item">
	   <td colspan="2" style="text-align: center;">Không tìm thấy kết quả trùng khớp ! </td>
	</tr>
@endforelse	