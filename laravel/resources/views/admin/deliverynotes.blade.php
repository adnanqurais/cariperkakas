
<html>
<head>
	<title>Tagihan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

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
  .table-information{
		width: 100%;
		border: 1pt solid black;
		border-collapse:collapse;
	}
  tr.border > th{
    height: 30px;
    padding-left: 10px;
		text-align: left;
		border:1pt solid black;
  }
  tr.border > td{
    height: 47px;
    padding-left: 10px;
		text-align: left;
		border:1pt solid black;
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
    padding: 7px;
		text-align: left;
    border-top: 1px solid #808080;
		border-bottom:1px solid #808080;
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
	</style>

</head>
<body>
	<!--Panel Order-->
	<h3 class="panel-title pull-left">
		Tagihan #<?php echo $invoice->invoiceid;?>
	</h3>

	<div class="row">
		<div class="col7">
			<!-- <strong>Salam Hormat : </strong> -->
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
						<h4>Informasi Penerima</h4>
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
					<div style="padding-top:-120px;">
						<!--INFORMASI PENGIRIMAN-->
						<h4>Informasi Pengiriman</h4>
						<table id="pengiriman" class="table-information">
              <thead>
                <tr class="border">
                  <th>Kurir</th>
                  <th>Paket</th>
                  <th>Tanggal Pengiriman</th>
                  <th>No Resi</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border">
  								<td><?php echo $invoice->shipping_courier ;?>&nbsp;</td>
                  <td><?php echo $invoice->shippingpackage ;?>&nbsp;</td>
                  <td><?php if(empty($invoice->resi)){?> Menunggu <?php }else{  ?><?php echo $invoice->resi ;?><?php } ?> &nbsp;</td>
                  <td><?php if(empty($invoice->resi)){?> Menunggu <?php }else{  ?><?php echo $invoice->resi ;?><?php } ?>&nbsp;</td>
  							</tr>
              </tbody>
						</table>
					</div>
				</div>

								<!--PURCHASED PRODUCT START-->
							<div style="margin-top:40px;">
                <h4>Informasi Pembelian</h4>
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
								</tbody>
						</table>
				</div>
				<!--PURCHASED PRODUCT END-->
		</body>
</html>
