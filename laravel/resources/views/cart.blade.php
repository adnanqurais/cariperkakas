@extends('app')

@section('content')
<div class="main-area container">
    <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ url('product') }}" type="button" class="btn btn-primary btn-sm btn-block">
                 Lanjut Belanja
            </a>
        </div>
    </div>
    @if(Session::has('success-delete'))
            <div class="alert alert-success">{{ Session::get('success-delete') }}</div>
    @endif
    @if(Session::has('success-voucher'))
    <div class="alert alert-success">{!! session('success-voucher') !!}</div>
    @endif
    @if(Session::has('error-voucher'))
    <div class="alert alert-danger">{!! session('error-voucher') !!}</div>
    @endif

    @if(Session::has('error-vouchervalue'))
    <div class="alert alert-danger">{!! session('error-vouchervalue') !!}</div>
    @endif
    <?php
    $ccart=Cart::count(false);
    if($ccart==0){
        echo "Tas Anda masih kosong.";
    }else{
    ?>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-hover table-rotation" >
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Product</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $ccart=Cart::count(false);
        if($ccart<>0){
        ?>
        <?php foreach($cart as $row) :?>

            <tr>
                <td style="vertical-align: middle;" data-label="Gambar Product"><img class="cart-img" src="img/product/thumb/<?php echo ($row->options->has('image') ? $row->options->image : '');?>"> &nbsp;</td>
                <td style="vertical-align: middle;" data-label="Product"><?php echo $row->name;?> &nbsp;<br><?php echo $row->options->var_code;?>&nbsp;(<?php echo $row->options->var_name;?>)</td>
                <td style="vertical-align: middle;" data-label="Weight"><?php echo $row->options->weight;?> <span> gram</span>&nbsp;
                <input type="hidden" class="totalWeightCart" value="<?php echo $row->options->weight * $row->qty;?>"name="totalWeightCart[]"/></td>
                <td style="vertical-align: middle;" data-label="Price"><span class="price_format"><?php echo $row->price;?></span> &nbsp;</td>
                <td style="vertical-align: middle;" data-label="Qty"><?php echo $row->qty;?></td>


                    <!--<input type="button" onclick="decrementValue()" value="-" />
                    <input type="text" name="quantity" value="<?php //echo $row->qty;?>" maxlength="2" max="10" onchange="qty()" size="1" id="number" class="text-center" />
                    <input type="button" onclick="incrementValue()" value="+" />-->&nbsp;
                </td>
                <td style="vertical-align: middle;" data-label="Subtotal"><span class="price_format"><p id="subtotal"><?php echo $row->subtotal;?></p></span> &nbsp;</td>
                <td style="vertical-align: middle;" data-label="Delete">
                <a href="#" title="delete" onclick="if(confirm('Are you sure?')) location.href='cart/delete/<?php echo $row->id;?> ' "><i class="icon ion-close-round"></i></a>&nbsp;
                </td>
            </tr>
             @if(isset($limitPromotionProduct[$row->id]))
                <tr>
                    <!-- SHOW PROMO FOR PRODUCT START -->
                    <td colspan="9" style="vertical-align: middle;" data-label=""><?php echo $limitPromotionProduct[$row->id]->promo_message; ?></td>
                    <!-- SHOW PROMO FOR PRODUCT END -->
                </tr>
             @endif
        <?php endforeach;?>

        <?php }else{?>
            <tr>
                    <td colspan="6" style="vertical-align: middle;" data-label="">Tas Anda Masih kosong &nbsp;</td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
        </div>
        <div class="col-md-4" style="padding-left:25px; overflow-x:hidden;">
            <form class=" form-inline" style="margin-left:-15px" action="{{ url('cart/getvoucher') }}" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="col-md-12">
            <br>
            <h4 class="center-text">Kode Voucher</h4>
            </div>
              <div class="form-group col-md-12">

                <div class="input-group">

                  <!--<div class="input-group-addon"><i class="fa fa-check"></i></div>-->

                  <input name="code" type="text" class="form-control input-flat" id="" placeholder="Kode Voucher" value="{{ old('code') }}" <?php if($ccart==0){echo "disabled"; } ?> required>
                  <div class="input-group-addon">- Rp
                    <?php
                    if(Session::get('vouchercode')) {
                        if(Session::get('vouchertype')==1){
                            $count=Cart::total()/100*Session::get('vouchervalue');
                            echo $count.' ( '.Session::get('vouchervalue').'%'.' )';

                        }elseif(Session::get('vouchertype')==2){
                            $total=Cart::total()-Session::get('vouchervalue');
                            echo Session::get('vouchervalue');
                        }
                    }else{
                        echo 0;
                    }
                    ?>
                </div>

                </div>
                <button type="submit" class="btn btn-primary btn-flat <?php if($ccart==0){echo "disabled"; } ?>">Cek</button>
              </div>
                
            </form> 
            <div class="row">
            <div class="col-md-12">
            <br>
            <h4 class="center-text">Shipping</h4>
            </div>
    </div>
    <div id="shippingprovince">
         <div class="row" id="loadingprov" >
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/small_loading.gif') }}" alt="loading">
            </div>
        </div>
    </div>

    <div id="shippingcity">
        <div class="row" id="loadingcit" style="display: none;">
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/small_loading.gif') }}" alt="loading">
            </div>
        </div>
    </div>

    <div id="shippingsubdistrict">
        <div class="row" id="loadingsub" style="display: none;">
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/small_loading.gif') }}" alt="loading">
            </div>
        </div>
    </div>

    <div id="shippingcost">
         <div class="row" id="loadingcost" style="display: none;">
            <div class="col-md-12 text-center">
                <img src="{{ asset('img/small_loading.gif') }}" alt="loading">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style=""><hr style="border: 0; width: 100%; margin: 0px auto; height: 2px; background-color: #808080;"></div>
    </div>

    <div class="row">
        <div id="carttotal" class="col-md-12">
            <table class="table table-hover">
                <tr>
                    <td><p>TOTAL</p></td>
                    <td>:&nbsp;</td>
                    <td><strong>
                    <span  class='price_format'>
                        <?php echo Cart::total(); ?>
                    </span>
                </strong></td>
                </tr>
                <tr>
                    <td><p>SHIPPING COST</p></td>
                    <td>:&nbsp;</td>
                    <td><strong>
                    <span id="shipping_cost" class='price_format'>
                        <?php
                        $ar = 0;
                        if(Session::get('ongkir')){
                            if($ccart != 0){
                                echo Session::get('ongkir');
                            } else {
                                echo Session::forget('ongkir');
                            }
                        }else{
                            echo $ar;
                        }?>
                    </span>
                </strong></td>
                </tr>
                <tr>
                    <td><p>GRAND TOTAL</p></td>
                    <td>:&nbsp;</td>
                    <td><strong>
                    <span id="total" class='price_format'>
                        <?php
                        if(Session::get('shoptotal')){
                            if($ccart != 0){
                                echo Session::get('shoptotal');
                            } else {
                                echo Session::forget('shoptotal');
                            }
                        }else{
                            echo Cart::total();
                        }?>
                    </span>
                </strong></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="row text-center">
        <div class="col-md-12">
            <div id="checkoutbtn">
                <?php if(Session::get('shoptotal')){?>
                            <a href="checkout/information" type="button" class="btn btn-success btn-block btn-flat">Checkout</a>
                <?php } else{?>
                <a href="checkout/information" type="button" class="btn btn-success btn-block btn-flat"  disabled>Checkout</a>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    
    </div>

    <?php   }   ?>
</div>

<script>
    $(document).ready(function() {
        //$.ajaxSetup({
        //    headers: {
        //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //    }
        //});
        //Fungsi untuk Shipping
        var token = $('#token').val();
        var dataString = '_token=' + token;
        //var dataString = '_token='+token +' &k_tujuan=' + k_tujuan;
        $.ajax({
            type: "POST",
            url: "{{ url('ajax/shippingprovince') }}",
            data: dataString,
            success: function(data) {
                $('#shippingprovince').html(data);
                get_city();
            }
        });
        //settimeout();
    });

    //Ajax untuk nampilkan kota
    function get_city() {
        $('#loadingcit').fadeIn();
        //Fungsi untuk Shipping
        var token = $('#token').val();
        var province = $('#province').val();
        var provincename = $("#province").find('option:selected').attr("data-name");

        var dataString = '_token=' + token + '&province=' + province + '&provincename=' + provincename;
        // var dataString = '_token='+ token +' &province=' + province;
        $.ajax({
            type: "POST",
            url: "{{ url('ajax/shippingcity') }}",
            data: dataString,
            success: function(data) {
                $('#shippingcity').html(data);
                getSubDistrict();
            }
        });
    }
    //Ajax untuk mempilkan harga


    //Ajax untuk mempilkan city
    function getSubDistrict() {
        $('#loadingsub').fadeIn();
        var token = $('#token').val();
        var city = $('#city').val();
        var cityname = $("#city").find('option:selected').attr("data-name");
        var dataString = '_token=' + token + '&city=' + city + '&cityname=' + cityname;
        $.ajax({
            type: "POST",
            url: "{{ url('ajax/shippingsubdistrict') }}",
            data: dataString,
            success: function(data) {
                $('#shippingsubdistrict').html(data);
                // alert(data);
                get_cost();
            }
        });
    }

    var weight = 0;
    function get_cost() {
        $('#loadingcost').fadeIn();
        //Fungsi untuk Shipping
        var package = $("#ongkir").attr("package-name");
        var ongkir = $('input[name="ongkir"]:checked').val();
        var token = $('#token').val();
        var city = $('#city').val();
        var cityname = $("#city").find('option:selected').attr("data-name");
        var subdistrict = $('#subdistrict').val();
        var subdistrictname = $("#subdistrict").find('option:selected').attr("data-name");
        $('.totalWeightCart').each(function(index, element) {

            weight = weight + parseFloat($(element).val());
        });
        var cityname = $("#city").find('option:selected').attr("data-name");
        var dataString = '_token=' + token + '&subdistrict=' + subdistrict + '&subdistrictname=' + subdistrictname + '&city=' + city + '&weight=' + weight + '&cityname=' + cityname;
        $.ajax({
            type: "POST",
            url: "{{ url('ajax/shippingcost') }}",
            data: dataString,
            success: function(data) {
                $('#shippingcost').html(data);
                set_ongkir(ongkir, package);
            }
        });
    }

    function set_ongkir(ongkir, package) {
        //Fungsi untuk Shipping
        var token = $('#token').val();
        var province = $('#province').val();
        var city = $('#city').val();
        var subdistrict = $("#subdistrict").find('option:selected').attr("data-name");
        if($('input[name="ongkir"]:checked').val() != 0) {
            $('#byReq').prop('disabled', true);
            var ongkir = $('input[name="ongkir"]:checked').val();
            var paket = package + ' RP ' + ongkir;
            var kurir = "JNE";
            setOngkir(token, province, subdistrict, city, ongkir, paket, kurir);
        } else {
            $('#byReq').prop('disabled', false);
            var kurir = " ";
            var paket = "Staff kami akan menghubungi anda untuk mengkonfirmasi PAKET yang akan anda gunakan melalui telepon.";
            var ongkir2 = 0;
            setOngkir(token, province, subdistrict, city, ongkir2, paket, kurir);
            $('#byReq').on('change', function() {
                var kurir = $('#byReq').val();
                var ongkir3 = 0;
                var paket = "Staff kami akan menghubungi anda untuk mengkonfirmasi PAKET yang akan anda gunakan melalui telepon.";
                setOngkir(token, province, subdistrict, city, ongkir3, paket, kurir);
            });
        }
    }

    function setOngkir(token, province, city, subdistrict, ongkir, paket, kurir) {
        var dataString = '_token=' + token
                                            + '&province=' + province
                                            + '&city=' + city
                                            + '&subdistrict=' + subdistrict
                                            + '&ongkir=' + ongkir
                                            + '&paket=' + paket
                                            + '&kurir=' + kurir;
        $.ajax({
            type: "POST",
            url: "{{ url('ajax/shippingongkir') }}",
            data: dataString,
            success: function(data) {
                $('#shipping_cost').load(location.href + ' #shipping_cost ', function() {
                    $('.price_format').priceFormat();
                });
                $('#total').load(location.href + ' #total ', function() {
                    $('.price_format').priceFormat();
                });
                $('#checkoutbtn').load(location.href + ' #checkoutbtn');
            }
        });
    }
</script>
@endsection
