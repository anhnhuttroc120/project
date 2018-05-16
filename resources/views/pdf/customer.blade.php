<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">
</head>
<body onload="window.print();">
<div id="page" class="page">
    <div class="header">
        <img style="width: 200px; height: 100px;" src="img/1.png">
    </div>
  <br/>
  <div class="title">
        HOA DON THANH TOAN
  </div>
  <br/>
  <br/>
  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>TEN</th>
      <th>SO LUONG</th>
      <th>DON GIA</th>
      <th>THANH TIEN</th>
    </tr>
    <?php $i=1;?>
    @foreach($order->orders_detail as $or)
    <?php
   
    if ($or->product->detail->sale_off > 0 ) 
    {
                $price = ((100 - $or->product->detail->sale_off)*($or->product->price))/100;
                } else {
                $price = $or->product->price;
                }
    ?>
    <tr>

      <td style="text-align: center;">{{$i}}</td>
      <td>{{$or->product->name}}</td>
      <td style="text-align: center;">{{$or->quantity}}</td>
      <td style="text-align: center;">{{number_format($price)}} VND</td>
      <td style="text-align: center;">{{number_format($or->total)}} VND</td>
    </tr>
    <?php $i++; ?>
    @endforeach
    <tr>
      <td colspan="4" class="tong">TONG TIEN</td>
      <td class="cotSo">{{number_format($order->total)}} VND</td>
    </tr>

  </table>
  <div class="footer-left"> Da Nang, ngay 16 thang 12 nam 2014<br/>
    Khach hang </div>
  <div class="footer-right"> Da Nang, ngay 16 thang 12 nam 2014<br/>
    Nhan vien </div>
</div>
</body>
</html>