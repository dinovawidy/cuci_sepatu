<html moznomarginboxes mozdisallowselectionprint>
<head>
	<meta charset="utf-8">
	<title>Cuci Sepatu - Print Nota</title>
	<style type="text/css">
		html { font-family: "Verdana, Arial"; }
		.content {
			width:  80mm;
			font-size: 12px;
			padding: 5px;
		}
		.title {
			text-align: center;
			font-size: 13px;
			padding-bottom: 5px;
			border-bottom: 1px dashed;
		}
		.head {
			margin-top: 5px;
			margin-bottom: 10px;
			padding-bottom: 10px;
			border-bottom: 1px solid;
		}
		table {
			width: 100%;
			font-size: 12px;
		}
		.thanks {
			margin-top: 10px;
			padding-top: 10px;
			text-align: center;
			border-top: 1px dashed;
		}
		@media print {
			@page {
				width: 80mm;
				margin: 0mm;
			}
		}
	</style>
</head>
<body onload="window.print()">
	<div class="content">
		<div class="title">
			<b>Shoes and Care</b>
			<br>
			Sidoarjo
		</div>

		<div class="head">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<td style="width:200px">
						<?php 
						echo Date("d/m/Y", strtotime($transaksi->date))." ". Date("H:i", strtotime($transaksi->transaksi_created));
						?>
					</td>
					<td>Kasir</td>
					<td style="text-align:center; width: 10px">:</td>
					<td style="text-align:right">
						<?=ucfirst($transaksi->user_name)?>
					</td>
				</tr>
				<tr>
					<td>
						<?=$transaksi->invoice?>
					</td>
					<td>Customer</td>
					<td style="text-align:center;">:</td>
					<td style="text-align:right">
						<?=$transaksi->customer_id == null ? "Umum" : $transaksi->customer_name?>
					</td>
				</tr>
			</table>
		</div>

		<div class="transaction">
			<table class="transaction-table" cellspacing="0" cellpadding="0">
				<?php 
				$arr_discount = array();
				foreach ($transaksi_detail as $key => $value) { ?>
					<tr>
						<td style="width:165px"><?=$value->name?></td>
						<td><?=$value->qty?></td>
						<td style="text-align:right; width: 60px"><?=$value->price?></td>
						<td style="text-align:right; width: 60px"><?=(($value->price - $value->discount_paket) * $value->qty)?>
							
						</td>
					</tr>
					<?php 
					if ($value->discount_paket > 0) {
						$arr_discount[] = $value->discount_paket;
					}
				}

				foreach ($arr_discount as $key => $value) { ?>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right">Disc.<?=($key+1)?></td>
						<td style="text-align:right"><?=$value?></td>
					</tr>
				<?php 
				} ?>

				<tr>
					<td colspan="4" style="border-bottom:1px dashed; padding-top:5px"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td style="text-align:right; padding-top:5px">Sub Total</td>
					<td style="text-align: right; padding-top:5px">
						<?=$transaksi->total_price?>
					</td>
				</tr>
				<?php if($transaksi->discount > 0) { ?>
					<tr>
						<td colspan="2"></td>
						<td style="text-align:right; padding-bottom:5px">Disc. Transaksi</td>
						<td style="text-align:right; padding-bottom:5px"><?=$transaksi->discount?></td>
					</tr>
					<?php
					} ?>
					<tr>
						<td colspan="2"></td>
						<td style="border-top:1px dashed; text-align:right; padding:5px 0">Grand Total</td>
						<td style="border-top:1px dashed; text-align:right; padding:5px 0">
							<?=$transaksi->final_price?>
						</td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td style="border-top:1px dashed; text-align:right; padding-top:5px">Cash</td>
						<td style="border-top:1px dashed; text-align:right; padding-top:5px">
							<?=$transaksi->cash?>
						</td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td style="text-align:right">Chage</td>
						<td style="text-align:right">
							<?=$transaksi->remaining?>
						</td>
					</tr>
			</table>
		</div>
		<div class="thanks">
			~~~ Thank You ~~~
			<br>
			Shoes and Care
		</div>
	</div>
</body>
</html>