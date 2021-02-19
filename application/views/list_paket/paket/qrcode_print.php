<!DOCTYPE html>
<html>
<head>
<meta chartset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge"> 
	<title>Qr-code Produk <?=$row->barcode?></title>
</head>
<body>

     <img src="uploads/qr-code/item-<?php $row->barcode?>.png" style="width:250px">
</body>
</html>
