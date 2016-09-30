@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Promotion
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Voucher  </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <form class="promo-form form-horizontal" action="{{ url('admin/promo/postview/'.$promolist->promo_id.'') }}" method="post">
                <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="{{ $promolist->enable}}"> Enable
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Promotion Name</label>
                            <div class="col-sm-9">
                                <input id="promotionName" class="form-control" placeholder="Name" name="promotionName" value="{{ $promolist->promo_title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Promotion Requirements</label>
                            <div class="col-sm-9">
                              <select id="promotionCategory" name="promotionCategory" class="form-control" style="text-transform:capitalize;">
                                  <option value="0">-- Select Requirements --</option>
                                  @foreach ($promo_req as $key)
                                    <option value="{{ $key->promo_req_id }}" <?php if($promolist->promo_requirements == $key->promo_req_id){echo 'selected="selected"';}?>>{{$key->promo_req_name}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left" >Requirements Value</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="minRequirement" name="minRequirement" placeholder="Min. Requirements" value="{{ $promolist->promo_min_req}}">
                            </div>
                            <div class="col-sm-1" style="text-align: center;">
                                <label><i class="fa fa-minus" aria-hidden="true"></i></label>
                            </div>
                            <div class="col-sm-4">
                                <input id="maxRequirement" class="form-control" name="maxRequirement"  placeholder="Max. Requirements" value="{{ $promolist->promo_max_req}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Reward Type</label>
                            <div class="col-sm-9">
                              <select name="rewardType" class="form-control" style="text-transform:capitalize;">
                                <option value="0">-- Select Type --</option>
                                @foreach ($promo_reward_type as $key)
                                  <option value="{{ $key->promo_type_id }}" <?php if($promolist->promo_reward_type == $key->promo_type_id){echo 'selected="selected"';}?>>{{$key->promo_type_name}}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Reward Value</label>
                            <div class="col-sm-9">
                                <input id="rewardValue" type="number" class="form-control" placeholder="Value" name="rewardValue" value="{{ $promolist->promo_reward_value}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Select Product <br> Reward</label>
                            <div id="productReward" class="col-sm-9">
                                <!-- Build your select: -->
                                <select class="form-control" name="productReward[]" id="select-product-reward" multiple="multiple">
                                    @foreach($product as $p)
                                    <option value='"{{ $p->productid }}"' <?php if( in_array('"'.$p->productid.'"',explode(';',$promolist->promo_reward_product))){ echo 'selected="selected"';} ?>>{{ $p->producttitle }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Date Validity</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="fromDate" name="fromDate" data-provide="datepicker" placeholder="From" value="{{ $promolist->promo_start_date}}">
                            </div>
                            <div class="col-sm-1" style="text-align: center;">
                                <label><i class="fa fa-minus" aria-hidden="true"></i></label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" id="untilDate" name="untilDate" data-provide="datepicker" placeholder="Until" value="{{ $promolist->promo_end_date}}">
                            </div>
                        </div>
                      </div><!--./row-->

                    </div><!--./Col-->
                    <div class="col-md-6">
                        <label>Select Product</label>
                        <div id="productPromo" class="form-group" style="padding-left: 2%;">
                            <!-- Build your select: -->
                            <select name="product[]" id="select-product" multiple="multiple" style="width: 100%;">
                                @foreach($product as $product)
                                <option value='"{{ $product->productid }}"' <?php if( in_array('"'.$product->productid.'"',explode(';',$promolist->product_id))){ echo 'selected="selected"';} ?>>{{ $product->producttitle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Category</label>
                        <div class="form-group" style="padding-left: 2%;">
                            <!-- Build your select: -->
                            <select name="category[]" id="select-category" multiple="multiple" style="width: 100%;">
                                @foreach($product_category as $product_cat)
                                <option value='"{{ $product_cat->categoryid }}"' <?php if( in_array('"'.$product_cat->categoryid.'"',explode(';',$promolist->category_id))){ echo 'selected="selected"';} ?>>{{ $product_cat->categorytitle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Brands</label>
                        <div class="form-group" style="padding-left: 2%;">
                            <!-- Build your select: -->
                            <select name="brands[]" id="select-brands" multiple="multiple" style="width: 100%;">
                                @foreach($product_brands as $product_brands)
                                <option value='"{{ $product_brands->brandsid }}"' <?php if( in_array('"'.$product_brands->brandsid.'"',explode(';',$promolist->brands_id))){ echo 'selected="selected"';} ?>>{{ $product_brands->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 text-left">Stacked*</label>
                            <div class="col-sm-8">
                                    <span class="col-sm-3 text-left"><input type="radio" class="stacked-status" name="stacked-status" value="1" <?php if($promolist->stacked_status == "1"){echo 'checked';}?>> <strong>No</strong></span>
                                    <span class="col-sm-3 text-left"><input type="radio" class="stacked-status" name="stacked-status" value="0" <?php if($promolist->stacked_status == "0"){echo 'checked';}?>> <strong>Yes</strong></span>
                                <label id="var-warning" style="color: #f00; font-size: 8pt" hidden>
                                    **PLEASE FILL THIS FORM**
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Promo Message</label>
                            <textarea class="form-group texteditor" name="promomessage">{{ $promolist->promo_message }}</textarea>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                </form>
                <div class="box-footer">
                    <div class="col-md-12">
                        <button onclick="promoSubmit()" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/voucher') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- Initialize the plugin: -->
<script>
    function promoSubmit() {
        var varStatus = $('input[name="var-status"]:checked').val();
        if ($('#promotionName').val() == null || $('input[name="promotionCategory"]:selected').val() == 0 || $('#minRequirement').val() == null || $('input[name="rewardType"]:selected').val() == 0 || $('#rewardValue').val() == null || $('input[name="stacked-status"]:checked').val() == null) {
            alert("Fill the form correctly");
            $('#var-warning').show();
        } else {
            if ($('#select-product').val() == null && $('#select-category').val() == null && $('#select-brands').val() == null) {
                alert("Fill the form correctly");
            } else {
                $('.promo-form').submit();
            }
        }
    };
    $(document).ready(function () {
      $("#select-product-reward").select2({
          placeholder: "Select Products"
      });
        $("#select-product").select2({
            placeholder: "Select Products"
        });
        $("#select-category").select2({
            placeholder: "Select Categories"
        });
        $("#select-brands").select2({
            placeholder: "Select Brands"
        });
    });

    $(function () {
        $("#fromDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy'
        }).datepicker("setDate", "0").on('change', function () {
            var selectedDate = $('#fromDate').datepicker('getDate');
            var today = new Date();
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            if (Date.parse(today) > Date.parse(selectedDate)) {
                alert('not today');
            }
        });
        $("#untilDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy',
            minDate: 0
        }).on('change', function () {
            var selectedDate = $('#untilDate').datepicker('getDate');
            var today = new Date();
            today.setHours(0);
            today.setMinutes(0);
            today.setSeconds(0);
            if (Date.parse(today) > Date.parse(selectedDate) || Date.parse(today) == Date.parse(selectedDate)) {
                alert('Choose Again');
            }
        });
    });
</script>
@endsection
