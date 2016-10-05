@extends('app')
@section('content')
    
<div id="checkoutPage"class="main-area container">

    {{-- <ul class="breadcrumb">
        <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
        <li class="active">Proses Checkout</li>
    </ul> --}}

    <div id="checkoutTabs" class="row">
        <div class="tabs">
            <!-- Radio button and lable for #tab-content1 -->
            <input type="radio" name="tabs" id="tab1" checked>
            <label for="tab1" id="label1">
                <h4 style="font-size: 10pt;"></i><span>INFORMASI<br>PENGIRIMAN</span></h4>
            </label>
            <!-- Radio button and lable for #tab-content2 -->
            <input type="radio" name="tabs" id="tab2" disabled>
            <label for="tab2" id="label2">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <h4 style="font-size: 10pt;"></i><span>METODE<br>PEMBAYARAN</span></h4>
            </label>
            <!-- Radio button and lable for #tab-content3 -->
            <input type="radio" name="tabs" id="tab3" disabled>
            <label for="tab3" id="label3">
                <h4 style="font-size: 10pt;"></i><span>KONFIRMASI<br>DATA&nbsp;</span></h4>
            </label>
            <div id="tab-content1" class="tab-content">
            <div class="col-xs-12">
            <div class="col-lg-7 col-md-12 col-xs-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">INFORMASI PENGIRIMAN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control  input-flat" placeholder="Nama Lengkap" value="<?php if(Session::get('memberid')){ echo $users->fullname; }elseif(Session::get('fullnameSession')){echo Session::get('fullnameSession');}?>"  id="fullname" name="fullname" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control  input-flat" placeholder="Email" value="<?php if(Session::get('memberid')){ echo $users->email;}elseif(Session::get('emailSession')){echo Session::get('emailSession');} ?>" id="email" name="email" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                  <textarea  class="form-control input-flat"  placeholder="Alamat" style="resize: vertical;" id="address" name="address" required><?php if(Session::get('memberid')){ echo $users->address;}elseif(Session::get('addressSession')){echo Session::get('addressSession');} ?></textarea>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kode Pos</label>
                                <input type="text" class="form-control  input-flat" placeholder="Kode Pos" value="<?php if(Session::get('memberid')){ echo $users->poscode; }elseif(Session::get('poscodeSession')){echo Session::get('poscodeSession');}?>" id="poscode" name="poscode" maxlength="5" required>
                              </div>
                              <div class="form-group">
                                <label for="">No Handphone</label>
                                <input type="text" class="form-control input-flat" placeholder="No Handphone" value="<?php if(Session::get('memberid')){ echo $users->handphone;}elseif(Session::get('handphoneSession')){echo Session::get('handphoneSession');} ?>" id="handphone" name="handphone" required>
                              </div>
                              <div class="form-group">
                                <label for="">Catatan</label>
                                <textarea class="form-control input-flat" style="resize:vertical;" id="note" name="note" value="<?php if(Session::get('noteSession')){echo Session::get('noteSession');}?>"></textarea>
                              </div>
                              <div class="form-group" style="text-align: center;">
                                
                              </div>
                              </div>
                              <!-- /.box-body -->

                              <div class="box-footer">
                                <button id="btnTab" onclick="goToPaymentMethod()" type="buttons" class="btn btn-primary btn-flat">Berikutnya</button>
                              </div>
                          </div>
                          <!-- /.box -->
                        </div>

                        <div class="col-lg-5 col-md-12 col-xs-12">
                          <div class="box box-warning">
                            <div class="box-header with-border">
                            <h3 class="box-title">Ringkasan Pemesanan</h3>
                          </div>
                          <div class="box-body">
                            <p>
                              Total Pembayaran : Rp. 2500000
                            </p>
                          </div>
                          </div>
                        </div>
                    </div>
            </div> <!-- #tab-content1 -->
            <div id="tab-content2" class="tab-content">
                <h3>Pilih Metode Pembayaran</h3>
                <form id="paymentOption" role="form">
                    <div style="width: auto; height: auto; padding: 2px 4px; float: left; cursor: pointer; margin: 0px 3px;">
                        <input type="radio" name="payment" value="transfer" style="cursor: pointer;"><label> Pembayaran Transfer</label>
                    </div>
                    <div style="width: auto; height: auto; padding: 4px; float: left; cursor: pointer;">
                        <input type="radio" name="payment" value="creditcard" style="cursor: pointer;"><label> Pembayaran Credit Card
                    </div></label>
                </form>
                <div class="col-sm-10 col-sm-offset-1" style="margin-top: 2%;">
                     <form id="form-payment-transfer" class="form-horizontal" action="{{ url('checkout/information') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="paymentMethod" id="paymentMethod">
                        <div id="transfer">
                            <div id="bankList" class="row" style="display: none;">
                                @foreach($banks as $b)
                                <div class="col-sm-6" style="text-align: center; margin-bottom: 20px;">
                                    <img class="img-responsive" src="{{ asset('img/bank-logo/'.$b->banklogo) }}" width="50%" style="margin:0px auto;">
                                    <h2>{{ $b->bankname }}</h2>
                                    <table style="margin:0px auto;">
                                        <tbody>
                                            <tr>
                                                <td>Account Number</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{ $b->banknumber }}</td>
                                            </tr>
                                            <tr>
                                                <td>Account Holder</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{ $b->bankholder }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                            <div id="creditcard" class="row" style="display: none; center; margin-bottom: 20px;">
                                @foreach($banks as $b)
                                <div class=" col-sm-6" style="text-align: center">
                                    <img class="img-responsive" src="{{ asset('img/bank-logo/'.$b->banklogo) }}" width="50%" style="margin:0px auto;">
                                    <h2>{{ $b->bankname }}</h2>
                                    <table style="margin:0px auto;">
                                        <tbody>
                                            <tr>
                                                <td>Account Number</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{ $b->banknumber }}</td>
                                            </tr>
                                            <tr>
                                                <td>Account Holder</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td>{{ $b->bankholder }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                            </div>
                         </form>
                        <div class="clearfix" style="text-align: center; padding: 10px 0px; margin-top: 20px;">
                            <div style="display:inline-block; vertical-align: middle;">
                                <button onclick="goToDataConfirmation()" class="btn btn-primary btn-flat">Make a Payment</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h4>Pilih Metode Pembayaran</h4>
                      </div>
                      <div class="box-body">
                        <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                              Transfer Bank</a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                              Kartu Visa/Mastercard</a>
                            </h4>
                          </div>
                          <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</div>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="box-footer">
                        <button onclick="backBtn2()" class="btn btn-primary btn-flat" >Kembali</button>
                      </div>
                    </div>
                      
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12">
                      <div class="box box-warning">
                            <div class="box-header with-border">
                            <h3 class="box-title">Ringkasan Pemesanan</h3>
                          </div>
                          <div class="box-body">
                            <p>
                              Total Pembayaran : Rp. 2500000
                            </p>
                          </div>
                          </div>
                    </div>
            </div> <!-- #tab-content2 -->

            <div id="tab-content3" class="tab-content">

              <div id="table-confirm">
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <legend>Informasi Pembelian</legend>
                          <table class="table table-hover table-rotation" style="margin-top:-30px;">
                             <thead>
                                 <tr>
                                     <th>Nama Produk</th>
                                     <th>Harga</th>
                                     <th>Jml.</th>
                                     <th>Subtotal</th>
                                     <th>&nbsp;</th>
                                 </tr>
                             </thead>
                             <tbody>
                             <?php foreach($cart as $row) :?>
                                 <tr style="font-size:10pt;">
                                     <td style="vertical-align: middle;" data-label="Product" ><?php echo $row->name;?><br><span style="font-size: 9pt;"><?php echo $row->options->var_code;?>&nbsp;<?php if($row->options->var_name != NULL || $row->options->var_name != ""){echo "( ".$row->options->var_name." )";}?></span></td>
                                     <td style="vertical-align: middle;" data-label="Price" style="font-size:9pt;"><span class="price_format"><?php echo $row->price;?></span> &nbsp;</td>
                                     <td style="vertical-align: middle;" data-label="Qty" style="font-size:9pt;"><?php echo $row->qty;?></td>&nbsp;</td>
                                     <td style="vertical-align: middle;" data-label="Subtotal" style="font-size:9pt;"><span class="price_format"><p id="subtotal"><?php echo $row->subtotal;?></p></span> &nbsp;</td>
                                 </tr>
                             <?php endforeach;?>
                            </tbody>
                         </table>
                    </div>
                    <div class="col-sm-6" style="float: right">
                        <!--<legend>Informasi Pembayaran</legend>-->
                        <table class="table">
                          <tbody>
                              <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td><strong>Total Harga Barang</strong></td>
                                    <td class="price_format" data-label="Total Harga Barang" ><?php echo Cart::total();?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td><strong>Diskon</strong></td>
                                    <td data-label="Discount"><?php echo Session::get('vouchervalue');?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td><strong>Biaya Pengiriman</strong></td>
                                    <td class="price_format" data-label="Biaya Pengiriman" ><?php echo Session::get('ongkir')?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td><strong>Total Pembayaran</strong></td>
                                    <td class="price_format" data-label="Total Pembayaran" ><?php echo Session::get('shoptotal')?></td>
                                </tr>
                          </tbody>
                        </table>
                    </div>
                </div><!--.col-->
                <div class="col-sm-6">
                  <legend>Informasi Pemesan</legend>
                  <table class="table">
                      <tbody>
                          <tr>
                              <td><strong>Fullname</strong></td>
                              <td> : </td>
                              <td><?php if(Session::get('memberid')){ echo $users->fullname; }elseif(Session::get('fullnameSession')){echo Session::get('fullnameSession');}?></td>
                          </tr>
                          <tr>
                              <td><strong>Email</strong></td>
                              <td> : </td>
                              <td><?php if(Session::get('memberid')){ echo $users->email; }elseif(Session::get('emailSession')){echo Session::get('emailSession');}?></td>
                          </tr>
                          <tr>
                              <td><strong>Handphone</strong></td>
                              <td> : </td>
                              <td><?php if(Session::get('memberid')){ echo $users->handphone; }elseif(Session::get('handphoneSession')){echo Session::get('handphoneSession');}?></td>
                          </tr>
                          <tr>
                              <td><strong>Kode Pos</strong></td>
                              <td> : </td>
                              <td><?php if(Session::get('memberid')){ echo $users->poscode; }elseif(Session::get('poscodeSession')){echo Session::get('poscodeSession');}?></td>
                          </tr>
                          <tr>
                              <td><strong>Alamat</strong></td>
                              <td> : </td>
                              <td>
                              <?php if(Session::get('memberid')){
                                echo $users->address;
                              }elseif(Session::get('addressSession')){
                                echo nl2br(Session::get('addressSession'));
                              }
                              ?></td>
                          </tr>
                          <tr>
                              <td><strong>Note</strong></td>
                              <td> : </td>
                              <td style=" word-wrap: break-word; max-width:90px;"><?php if(Session::get('noteSession')){echo Session::get('noteSession');}?></td>
                          </tr>
                      </tbody>
                  </table>
                </div><!--.col-->
                <div class="col-sm-6">
                  <legend>Informasi Pengiriman</legend>
                  <table class="table">
                      <tbody>
                          <tr>
                              <td><strong>Kurir</strong></td>
                              <td> : </td>
                              <td><?php echo Session::get('kurir'); ?></td>
                          </tr>
                          <tr>
                              <td><strong>Paket Yang Digunakan</strong></td>
                              <td> : </td>
                              <td><?php echo Session::get('package'); ?></td>
                          </tr>
                          <tr>
                              <td><strong>Provinsi</strong></td>
                              <td> : </td>
                              <td><?php echo Session::get('provincename'); ?></td>
                          </tr>
                          <tr>
                              <td><strong>Kota</strong></td>
                              <td> : </td>
                              <td><?php echo Session::get('cityname'); ?></td>
                          </tr>
                          <tr>
                              <td><strong>Kecamatan</strong></td>
                              <td> : </td>
                              <td><?php echo Session::get('subdistrictname'); ?></td>
                          </tr>
                      <tr>
                              <td><strong>Alamat Tujuan</strong></td>
                              <td> : </td>
                              <td><?php echo nl2br(Session::get('addressSession')); ?></td>
                          </tr>
                          <tr>
                              <td><strong>Biaya Pengiriman</strong></td>
                              <td> : </td>
                              <td class="price_format"><?php echo Session::get('ongkir');?></td>
                          </tr>
                      </tbody>
                  </table>
                </div><!--.col-->
                <div class="col-sm-12">
                    <div class="col-sm-4">
                        <legend>Metode Pembayaran</legend>
                        <table class="table">
                          <tbody>
                              <tr>
                                  <td><strong>Payment Method</strong></td>
                                  <td> : </td>
                                  <td style="text-transform: capitalize"><?php if(Session::get('paymentSession')){ echo Session::get('paymentSession');}?></td>
                          </tr>
                          </tbody>
                        </table>
                    </div>
                </div><!--.col-->
                <div style="display:inline-block; vertical-align: middle; float: right">
                    <button id="btnBack" onclick="backBtn()" type="button" class="btn btn-primary btn-flat" >Kembali</button>
                    <button id="btnSubmit" onclick="submitConfirmation()" type="button" class="btn btn-primary btn-flat" >Konfirmasi</button>
                </div>
              </div><!--.row-->
            </div> <!-- #tab-content3 -->
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('template/frontend/js/checkoutInformation.js') }}"></script>
<script>
    var text1 = "STEP-1";
    var text2 = "STEP-2";
    var text3 = "STEP-3";

    function goToPaymentMethod() {
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var poscode = $('#poscode').val();
        var handphone = $('#handphone').val();
        var note = $('#note').val();
        var dataString = '_token=' + token
                                        + '&fullname=' + fullname
                                        + '&email=' + email
                                        + '&address=' + address
                                        + '&poscode=' + poscode
                                        + '&note=' + note
                                        + '&handphone=' + handphone;
        $.ajax({
            type: "GET",
            url: "{{ url('ajax/getNextTab') }}",
            data: dataString,
            success: function(data) {
                $('#tab1').prop('checked', false);
                $('#tab1').prop('disabled', true);
                $('#tab2').prop('disabled', false);
                $('#label2').click();
            },
            error: function(data) {
                alert("THERE IS SOMETHINGS WRONG!!!");
            }
        });
    }
    function goToDataConfirmation() {
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var poscode = $('#poscode').val();
        var handphone = $('#handphone').val();
        var note = $('#note').val();
        var payment = $('input[name="payment"]:checked').val();
        var dataString = '_token=' + token
                                        + '&fullname=' + fullname
                                        + '&email=' + email
                                        + '&address=' + address
                                        + '&poscode=' + poscode
                                        + '&note=' + note
                                        + '&payment=' + payment
                                        + '&handphone=' + handphone;
        $.ajax({
            type: "GET",
            url: "{{ url('ajax/getNextTab') }}",
            data: dataString,
            success: function(data) {
                $('#tab2').prop('checked', false);
                $('#tab2').prop('disabled', true);
                $('#tab3').prop('disabled', false);
                $('#table-confirm').load(location.href + ' #table-confirm', function() {
                    $('.price_format').priceFormat();
                    $('#label3').click();
                });
            },
            error: function(data) {
                alert("THERE IS SOMETHINGS WRONG!!!");
            }
        });
    }
</script>

@endsection
