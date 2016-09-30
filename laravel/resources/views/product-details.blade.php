@extends('app')

@section('content')
<style>

</style>


<div class="main-area container" style="letter-spacing:1px;">
  <div class="row">
    {{-- <div class="col-md-12">
      <ul class="breadcrumb">
          <li><a href="#"><i class="icon ion-ios-home"></i></a></li>
          <li class="active">Detail Produk</li>
          <li class="active">{{ $products->producttitle}}</li>
      </ul>
    </div> --}}
  </div>
    <div class="row">
        <!--Product Image-->
        <div class="col-md-5 hidden-sm hidden-xs">
            <div class="dekstop-productdetail-image col-md-12" style="border: 2px solid #ddd;">
              <!-- <div class="o">
              </div> -->
                <?php if(!empty($products_img_primary->image_small)){ ?>
                  <img id="zoom_img" class="img-responsive" src="{{ url('img/product/small/'.$products_img_primary->image_small.'') }}" data-zoom-image="{{ url('img/product/large/'.$products_img_primary->image_large.'') }}" />
                <?php } else{?>
                  <img class="grid-img" src="{{ url('img/no-image.jpg') }}" style="border: 2px solid #ddd"/>
                <?php } ?>
            </div><!--./Dekstop-product-image-->
            <div id="gal1" class="col-md-12">
              <div class="row">
                @foreach($products_img as $prod_img)
                <a class="col-md-3 hidden-sm hidden-xs" href="#" data-image="{{ url('img/product/small/'.$prod_img->image_small.'') }}" data-zoom-image="{{ url('img/product/large/'.$prod_img->image_large.'') }}" >
                    <img id="zoom_img" class="img-responsive" src="{{ url('img/product/thumb/'.$prod_img->image_thumb.'')}}" style="border: 2px solid #ddd;"/>
                </a>
                @endforeach
              </div>
            </div>
        </div><!--./col Product Image-->

        <!--Product Info-->
        <div class="col-md-7">


            @if(Session::has('stocknull'))
            <div class="alert alert-danger">{{ Session::get('stocknull') }}</div>
            @endif
            @if(Session::has('success-addcart'))
            <div class="alert alert-success">{{ Session::get('success-addcart') }}</div>
            @endif
            <h3 style="font-weight:900;">{{ $products->producttitle}}</h3>
            <div><span>Brand :&nbsp;</span><span>{{ $products->name}} &nbsp;</span></div>
            <div><span>Kategori :</span><span style="display: none;"></div>
            <?php
                $cateExpl = explode(",", $products->category);

            ?></span>
            <div class="col-xs-12 hidden-md hidden-lg">
                <div id="mobile-productdetail-image" class="owl-carousel owl-theme">
                @foreach($products_img as $prod_img)
                  <div class="item"><img class="img-responsive" src="{{ url('img/product/small/'.$prod_img->image_small.'') }}" alt="1" style="padding: 0px 10px; margin:0px auto;"></div>
                @endforeach
                </div>
            </div>
            @if($prod_variation == NULL)
                <h3 id="priceVar" class="clearfix" style="font-weight:800; margin-top:4px;"><span id="test" class="price_format">{{ $products->price}}</span></h3>
            @else
                <h3  id="priceVar" class="clearfix" style="font-weight:800; margin-top:4px;"><span id="test" class="price_format">{{ $prod_variation[0]->var_price }}</span></h3>
            @endif

            <!--<code>Stok : {{-- $products->stock--}} </code>-->
            <form class="form-inline" action="{{ url('addcart') }}" method="post">
               <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
               <input type="hidden" value="<?php echo Cart::count(false); ?>" name="cart">
               <input type="hidden" value="{{ $products->productid}}" name="code">
               <input type="hidden" value="{{ $products->brands}}" name="brandsid">
               <input type="hidden" value="{{ $products->category}}" name="categoryid">

                @if($prod_variation != NULL)
               <input type="hidden" id="var_id" value="{{ $prod_variation[0]->var_id }}" name="variantId">
                @endif
               <input type="hidden" value="{{ $products->producttitle}}" name="title">
                @if($prod_variation == NULL)
                    <input type="hidden" value="{{ $products->price }}" name="price">
                @else
                    <input type="hidden" value="{{ $prod_variation[0]->var_price }}" name="price">
                @endif
               <input type="hidden" value="{{ $products->image_thumb}}" name="image">
               <input type="hidden" value="{{ $products->weight}}" name="weight">
               <input type="hidden" value="{{ $products->volume}}" name="volume">

               <?php if($prod_variation != NULL){?>
                <!--PRODUCT VARIATION START-->
               <div class="form-group col-sm-12" style='padding-left:0px; <?php if(count($prod_variation) == 1){echo "display:none";}?>'>
                <select class="form-control" id="product_var" onchange="changeVar()">
                    @foreach($prod_variation as $pv)
                    <option value="{{ $pv->var_id }}">{{ $pv->var_name }} ({{ $pv->var_code }})</option>
                    @endforeach
                </select>
              </div>
              <div class="col-sm-12" style='padding-left:0px; <?php if(count($prod_variation) >> 1){echo "display:none";}?>'>
               <p id="product_var" style="font-weight:700;">{{ $prod_variation[0]->var_name }} ({{ $prod_variation[0]->var_code }})</p>
             </div>
             <?php } ?>
                <!--PRODUCT VARIATION END-->

              <div class="form-inline">
                  <div class="form-group" style='padding-left:0px;'>
                    <input type="number" min="1"class="form-control" value="1" name="qty">
                  </div>
                  <button type="submit" class="btn btn-warning">Beli</button>
              </div>
            </form>

            <div style="bottom: 0px; ">
                <h4>Informasi Produk</h4>
                 <?php
                    echo nl2br($products->productinformation, false);
                 ?>
                <table style="margin-top: 2.5%;">
                    @foreach($prod_information_details as $pid)
                    <tr>
                        <td style="padding-right: 5px;">{{ $pid->title }}</td>
                        <td style="padding-right: 5px;"> : </td>
                        <td>{{ $pid->value }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div><!--./Product Info-->
    </div><!--./rows-->


    <div class="row">
      <div class="col-md-12">
        <hr>
        <ul class="nav nav-tabs">
          <li class="active" ><a data-toggle="tab" href="#deskripsiProduct"><h4>Deskripsi Produk</h4></a></li>
          <li><a data-toggle="tab" href="#spesifikasiProduct"><h4>Spesifikasi</h4></a></li>
        </ul>

        <div class="tab-content box-line-detail">
          <div id="deskripsiProduct" class="tab-pane fade in active">
            <p>
               <?php
                  if($products->productdescription == NULL){
                      echo "Tidak ada deskripsi lebih lanjut untuk produk ini";
                  }else{
                      echo nl2br($products->productdescription, false);
                  }
                ?>
            </p>
          </div>
          <div id="spesifikasiProduct" class="tab-pane fade">
            <p>
              Tidak ada spesifikasi lebih lanjut untuk produk ini
               <?php
                  if($products->productspecification == NULL){
                      echo "Tidak ada spesifikasi lebih lanjut untuk produk ini";
                  }else{
                      echo nl2br($products->productspecification, false);
                  }
                ?>
            </p>
          </div>
        </div>
        <!-- <div id="var-detail">
            <div class="row" id="loadingVarDet" style="display: none;">
                <div class="col-sm-4 text-center">
                    <img src="{{ asset('img/small_loading.gif') }}" alt="loading">
                </div>
            </div>
        </div> -->

      </div>
    </div><!--./rows-->
</div><!--./container-->
<script>
    function changeVar() {
        //alert($('#product_var').val());
        var token = $('#token').val();
        $('#var_id').val($('#product_var').val());
        var variantId = $('#product_var').val();
        var dataString = '_token=' + token + '&variantId=' + variantId;
        $.ajax({
            type: "GET",
            url: "{{ url('ajaxVariation/priceVariant') }}",
            data: dataString,
            success: function (data) {
                $('#test').load(location.href + ' #test ', function () {
                    $('#test').html(data);
                    $('.price_format').priceFormat();
                });
                getVariantDetails()
            },
            error: function () {
                alert("EROR");
            }
        });
    }


    function getVariantDetails() {
        $('#loadingVarDet').fadeIn();
        //alert("AKU");
        var token = $('#token').val();
        var variantId = $('#product_var').val();
        var dataString = '_token=' + token + '&variantId=' + variantId;
        $.ajax({
            type: "GET",
            url: "{{ url('ajaxVariation/detailVariant') }}",
            data: dataString,
            success: function (data) {
                $('#var-detail').html(data);
            }
        });
    }
</script>

@endsection
