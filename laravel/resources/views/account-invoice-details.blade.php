@extends('app')

@section('content')

<style>

    @media screen and (max-width: 900px) {
        .tableresponsive {
            border: 0;
        }

        .tableresponsive thead,tfoot {
            display: none;
        }

        .tableresponsive tr {
            margin-bottom: 10px;
            display: block;
            border-bottom: 2px solid #ddd;
        }

        .tableresponsive td {
            display: block;
            text-align: right;
            font-size: 13px;
            border-bottom: 1px dotted #ccc;
        }

        .tableresponsive td:last-child {
            border-bottom: 0;
        }

        .tableresponsive td:before {
            content: attr(data-label);
            float: left;
            text-transform: uppercase;
            font-weight: bold;
        }
    }
    .paddingLeft{
         padding-left: 10px;
    }

</style>
<div class="main-area container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
            <li class="active">Akun</li>
        </ul>
    <!--row-->
    <div class="row">
        <!--col-->
        <div class="col-md-3">

            <ul class="mobile-menu-account nav nav-pills nav-stacked">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Menu
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                          <li class="active"><a data-toggle="tab" href="{{ url('account/profile') }}">Profil</a></li>
                          <li><a data-toggle="tab" href="{{ url('account/invoice') }}">Tagihan</a></li>
                          <!--<li><a data-toggle="tab" href="#bookaddress">Buku Alamat</a></li>-->
                          <li><a href="{{ url('logout') }}">Keluar</a></li>
                    </ul>
                </li>
            </ul>
            <?php
                if(Session::get('sessionmember')){?>
                     <ul class="dekstop-menu-account menu-vertical">
                      <li class="active"><a href="{{ url('account/profile') }}">Profil</a></li>
                      <li><a href="{{ url('account/invoice') }}">Tagihan</a></li>
                      <li><a href="{{ url('logout') }}">Keluar</a></li>
                    </ul>
            <?php }?>



        </div>
        <!--./Col-->

        <!--col-->
        <div class="<?php if(Session::get('sessionmember')){ echo "col-md-9";}else{echo "col-md-12"; } ?>">
                @if(Session::has('success-checkout'))
                <div class="alert alert-success">{{ Session::get('success-checkout') }}</div>
                @endif
                <!-- Content-->
                  <!--Panel Order-->
                  <div class="panel collapse in">
                    <div class="panel-heading">
                         <h3 class="panel-title pull-left">
                          Tagihan #{{ $invoice->invoiceid }}
                          </h3>
                        <!--<button class="close" data-toggle="collapse" data-target="#account-order">&times;</button>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <!--Panel body-->
                        <table class="table tableresponsive">
                        <thead>
                          <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Pesanan</th>
                            <th>Sub Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($detailinvoice as $detail)
                          <tr>
                            <td data-label="Tagihan">{{ $detail->productcode }} <?php if($detail->var_name != null || $detail->var_name != 0 || $detail->var_name != ""){echo " -"." ".$detail->var_name;}?>&nbsp;</td>
                            <td data-label="Produk">{{ $detail->producttitle }} &nbsp;</td>
                            <td data-label="Jumlah Pesanan">{{ $detail->qty }} &nbsp;</td>
                            <td data-label="Sub Total"><span class="price_format"><?php echo $detail->subtotal;?></span> &nbsp;</td>
                          </tr>
                          @endforeach
                          @if(empty($detailinvoice))
                          <tr>
                            <td colspan="5">Belum ada Pesanan</td>
                          </tr>
                          @endif
                          <tr>
                            <td colspan="2">&nbsp;</td>
                            <td> Diskon</td>
                            <td> - <span class="price_format">{{ $invoice->disc }}</span>&nbsp;</td>
                          </tr>
                          <!--SHIPPING COST START-->
                          <tr>
                            <td colspan="2">&nbsp;</td>
                            <td>Biaya Pengiriman</td>
                            <td><span class="price_format">{{ $invoice->shippingcost }}</span>&nbsp;</td>
                          </tr>
                          <!--SHIPPING COST END-->
                          <!--TOTAL HARGA START-->
                          <tr>
                            <td colspan="2">&nbsp;</td>
                            <td> Total</td>
                            <td><span class="price_format">{{ $invoice->total }}</span>&nbsp;</td>
                          </tr>
                          <!--TOTAL HARGA END-->
                        </tbody>

                        </table>



                        <hr>
                      <div class="">
                        <div class="col-sm-6">
                          <H4>Informasi Pesanan</H4>
                            <!--items-->

                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Waktu Pesan</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->orderdate }}
                            </div>
                          </div>

                        <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Total</p>
                            </div>
                            <div class="col-xs-8">
                            <span class="price_format">{{ $invoice->total }}</span>
                            </div>
                          </div>

                          <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Status</p>
                            </div>
                            <div class="col-xs-8">
                                  <?php
                                  if($invoice->status==0){?>
                                      <div class="label label-warning">Pending</div>
                                  <?php }elseif($invoice->status==1){  ?>
                                      <div class="label label-success">Processing</div>
                                  <?php } ?>
                            </div>
                          </div>
                          <!--./items-->

                        <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Catatan</p>
                            </div>
                            <div class="col-xs-8">
                            <?php echo nl2br($invoice->order_note);?>
                            </div>
                        </div>
                          <!--./items-->

                        <legend></legend>

                        <H4>Informasi Pengiriman</H4>


                        <div class="row paddingLeft">
                          <div class="col-xs-4">
                          <p>Kurir</p>
                          </div>
                          <div class="col-xs-8">
                              {{ $invoice->shipping_courier }}
                          </div>
                        </div>
                         <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Paket</p>
                            </div>
                            <div class="col-xs-8">
                                {{ $invoice->shippingpackage }}
                            </div>
                          </div>

                          <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>No Resi</p>
                            </div>
                            <div class="col-xs-8">
                             <?php
                                  if(empty($invoice->resi)){?>
                                      <div class="label label-warning">Menunggu</div>
                                  <?php }else{  ?>
                                      {{ $invoice->resi }}
                                  <?php } ?>
                            </div>
                          </div>
                          <!--./items-->

                            <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Tanggal Pengiriman</p>
                            </div>
                            <div class="col-xs-8">
                             <?php
                                  if(empty($invoice->delivery_date)){?>
                                      <div class="label label-warning">Menunggu</div>
                                  <?php }else{  ?>
                                      {{ $invoice->delivery_date }}
                                  <?php } ?>
                            </div>
                          </div>
                          <!--./items-->

                        </div>
                        <div class="col-sm-6">
                        <H4>Info Pengiriman</H4>
                         <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Nama Lengkap</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_fullname }}
                            </div>
                          </div>
                          <!--./items-->
                         <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Alamat</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_address }}
                            </div>
                          </div>
                          <!--./items-->
                           <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Kota</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_city }}
                            </div>
                          </div>
                          <!--./items-->
                          <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Kecamatan</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_subdistrict }}
                            </div>
                          </div>
                          <!--./items-->
                          <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Kode Pos</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_poscode }}
                            </div>
                          </div>
                          <!--./items-->
                           <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>Provinsi</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_province }}
                            </div>
                          </div>
                          <!--./items-->
                          <!--items-->
                          <div class="row paddingLeft">
                            <div class="col-xs-4">
                            <p>No Telepon</p>
                            </div>
                            <div class="col-xs-8">
                            {{ $invoice->order_handphone }}
                            </div>
                          </div>
                          <!--./items-->

                        </div>
                      </div><!--./row-->
                    </div><!--./Panel body-->
                    <div class="panel-footer text-right" style="padding:10px 0px !important">
                        <?php if($invoice->status==0){?>
                          <a href="{{ url('account/invoice') }}" class="btn btn-default">Kembali</a>
                        <?php } ?>

                        <a href="{{ url('invoice/'.$invoice->invoiceid) }}" class="btn btn-success">Download PDF</a>
                        <a href="{{ url('payment-confirmation/'.$invoice->invoiceid) }}" class="btn btn-warning" style="margin-right:7px;">Konfirmasi</a>
                    </div>
                </div><!--./Panel-->


        </div>
        <!--./Col-->


    </div><!--./row-->

</div><!--./container-->
@endsection
