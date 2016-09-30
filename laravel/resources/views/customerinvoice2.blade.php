
<html>
<head>
	<title>Tagihan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


        <link rel="stylesheet" href="template/web/css/bootstrap/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link href="template/web/css/invoice.css" rel="stylesheet">
	<style>
	body{
		margin: 0;
		padding: 0;
		font-family: 'Lato';
	}
	.detail-padding {
		padding: 2px;
	}
	.table{
		width: 100%;
		border-bottom: 1pt solid black;
		border-collapse:collapse;
	}
	.table tr td, .table tr th{
		padding: 5px 0;
	}
	tr.border_bottom td{
		padding: 7px;
		text-align: left;
		border-bottom:1px solid #808080;
	}
	tr.border_bottom th{
		text-align: left;
		border-bottom:1pt solid black;
	}
	.row{
		width: 100%;
	}
	.col1{
		width: 10% !important;
		display: inline-block;
		float: left;
	}
	.col2{
		width: 20% !important;
		display: inline-block;
		float: left;
	}
	.col3{
		width: 33.33333% !important;
		display: inline-block;
		float: left;
	}
	.col4{
		width: 40% !important;
		display: inline-block;
		float: left;
	}
	.col5{
		width: 50% !important;
		display: inline-block;
		float: left;
	}
	.col6{
		width: 60% !important;
		display: inline-block;
		float: left;
	}
	.col7{
		width: 60% !important;
		display: inline-block;
		float: left;
	}
	.col8{
		width: 80% !important;
		display: inline-block;
		float: left;
	}
	.col9{
		width: 90% !important;
		display: inline-block;
		float: left;
	}

	.paddingLeft{
		padding-left: 10px;
	}

	.page-break {
		page-break-after: always;
	}
     .color1 {
         color: #656B79;
     }
     .color2 {
         color: #000000;
     }
     /*.color3 {
     }
     .color4 {
     }
     .color5 {
     }
     .color6 {
     }
     .color7 {
     }
     .color8 {
     }*/
	</style>

</head>
<body>
    <div class="col-md-6">
        INI CUMA TESTING AJA
    </div>
    <div class="col-md-6">
        GAK BAKAL DISIMPEN GITU AJA.......
    </div>
	<!--Panel Order-->
	<h3 class="color1 panel-title pull-left" style="margin-top: -20px;">
		Tagihan #<?php echo $invoice->invoiceid;?>
	</h3>

	<div class="row">
		<div class="col7">
			<strong>Salam Hormat : </strong>
			<p><?php echo $config->sitename;?><br>
				<?php echo $config->companyname;?><br>
				Head Office<br>
				<?php
				echo nl2br($config->address, false);
				?> <br>
				<?php echo $config->telephone;?></p>
			</div>
			<div class="col3">
				<strong>Metode Pembayaran : </strong>
				<p>
					<?php
					foreach($bank as $b){
						echo $b->bankname.':'.$b->banknumber.'<br>';
					}
					?><br>

				</p>

			</div>
		</div>

		<div style="margin-bottom:0px; padding-bottom:0px;">
			<div class="col5">

				<!--INFORMASI PEMESANAN-->
				<h4>Pesanan</h4>
				<!--Item-->
				<table>
					<tr>
						<td>Waktu Pesan</td>
						<td> : </td>
						<td><?php echo $invoice->orderdate ;?>&nbsp;</td>
					</tr>
					<tr>
						<td>Total</td>
						<td> : </td>
						<td>Rp <?php echo $invoice->total;?>&nbsp;</td>
					</tr>
					<tr>
						<td>Status</td>
						<td> : </td>
						<td><?php
						if($invoice->status==0){?>
							Belum lunas
							<?php }elseif($invoice->status==1){  ?>
								Lunas
								<?php } ?>&nbsp;</td>
							</tr>
							<tr>
								<td>Catatan</td>
								<td> : </td>
								<td><?php echo nl2br($invoice->order_note);?>&nbsp;</td>
							</tr>
						</table>
					</div>

					<div class="col5">

						<!--INFORMASI PENERIMA-->
						<h4>Penerima</h4>
						<table>
							<tr>
								<td>Nama Lengkap</td>
								<td> : </td>
								<td><?php echo $invoice->order_fullname ;?>&nbsp;</td>
							</tr>
							<tr>
								<td style="vertical-align: text-top;">Alamat</td>
								<td style="vertical-align: text-top;"> : </td>
								<td><?php echo $invoice->order_address ;?>&nbsp;</td>
							</tr>
							<tr>
								<td>Kota</td>
								<td> : </td>
								<td><?php echo $invoice->order_city;?>&nbsp;</td>
							</tr>
							<tr>
								<td>Kode Pos</td>
								<td> : </td>
								<td><?php echo $invoice->order_poscode;?>&nbsp;</td>
							</tr>
							<tr>
								<td>Provinsi</td>
								<td> : </td>
								<td><?php echo $invoice->order_province;?>&nbsp;</td>
							</tr>
							<tr>
								<td>No Telepon</td>
								<td> : </td>
								<td><?php echo $invoice->order_handphone;?>&nbsp;</td>
							</tr>
						</table>
					</div>
				</div>
				<div>
					<div class="col5" style="padding-top:-120px;">
						<!--INFORMASI PENGIRIMAN-->
						<h4>Pengiriman</h4>
						<table>
							<tr>
								<td style="vertical-align: text-top;">Kurir</td>
								<td style="vertical-align: text-top;"> : </td>
								<td><?php echo $invoice->shipping_courier ;?>&nbsp;</td>
							</tr>
							<tr>
								<td style="vertical-align: text-top;">Paket</td>
								<td style="vertical-align: text-top;"> : </td>
								<td><?php echo $invoice->shippingpackage ;?>&nbsp;</td>
							</tr>
							<tr>
								<td>No Resi</td>
								<td> : </td>
								<td><?php
								if(empty($invoice->resi)){?>
									Menunggu
									<?php }else{  ?>
										<?php echo $invoice->resi ;?>
										<?php } ?>&nbsp;</td>
									</tr>
									<tr>
										<td>Tanggal Pengiriman</td>
										<td> : </td>
										<td><?php
										if(empty($invoice->delivery_date)){?>
											Menunggu
											<?php }else{  ?>
												<?php echo $invoice->delivery_date;?>
												<?php } ?>&nbsp;</td>
											</tr>
											<tr>
												<td>Catatan</td>
												<td> : </td>
												<td><?php echo nl2br($invoice->order_note);?>&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>

								<!--PURCHASED PRODUCT START-->
							<div style="margin-top:40px;">
								<table class="table">
										<thead>
											<tr class="border_bottom">
												<th style="width: 17%;">Kode Produk</th>
												<th>Nama Produk</th>
												<th style="width:15%;">Jumlah</th>
												<th style="width: 20%;">Sub Total</th>
											</tr>
										</thead>
										<tbody>
									    <?php foreach($detailinvoice as $detail){ ?>
										<tr class="border_bottom">
											<td data-label="Tagihan">#<?php echo $detail->productcode;?> &nbsp;</td>
											<td data-label="Produk"><?php echo $detail->producttitle;?>&nbsp;</td>
											<td data-label="Jumlah Pesanan"><?php echo $detail->qty ;?> &nbsp;</td>
											<td data-label="Sub Total">Rp <?php echo $detail->subtotal;?> &nbsp;</td>
										</tr>
										<?php } ?>
										<?php if(empty($detailinvoice)){ ?>
										<tr>
											<td colspan="5">Belum ada Pesanan</td>
										</tr>
										<?php } ?>
										<tr>
		                                    <td colspan="2">&nbsp;</td>
		                                    <td style="width: 20%;">Total Harga Barang</td>
		                                    <td>Rp <?php echo $invoice->total_product_payment ;?>&nbsp;</td>
		                                </tr>
										<tr>
											<td colspan="2">&nbsp;</td>
											<td style="width: 20%;"> Diskon</td>
											<td> - Rp <?php echo $invoice->disc ;?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
											<td style="width: 20%;"> Biaya Pengiriman</td>
											<td> Rp <?php echo $invoice->shippingcost ;?>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="2">&nbsp;</td>
											<td style="width: 20%;"> Total</td>
											<td>Rp <?php echo $invoice->total ;?>&nbsp;</td>
										</tr>
								</tbody>
						</table>
				</div>
				<!--PURCHASED PRODUCT END-->
		</body>
</html>
