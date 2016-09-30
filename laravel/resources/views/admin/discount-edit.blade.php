@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Discount
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('admin/') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Discount  </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
                @if(Session::has('create-failed'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('create-failed') }}
                    </div>
                @endif
              <div class="box">
                <form class="discount-form form-horizontal" action="{{ url('admin/discount/view/'.$discountList->id.'') }}" method="post">
                <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                        <!--<div class="form-group">
                            <label class="col-sm-3 text-left">Public</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Discount Name</label>
                            <div class="col-sm-9">
                                <input id="discountName" class="form-control" placeholder="Name" name="discountName" value="{{ $discountList->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Discount Type</label>
                            <div class="col-sm-9">
                              <select name="discountType" class="form-control" style="text-transform: capitalize">
                                  <option value="0">-- Select Type --</option>
                                  <option value="nominal" <?php if($discountList->discount_type == "nominal"){echo 'selected';}?>>Nominal</option>
                                  <option value="percentage" <?php if($discountList->discount_type == "percentage"){echo 'selected';}?>>Percentage</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Discount Value</label>
                            <div class="col-sm-9">
                                <input id="discountValue" type="number" class="form-control" placeholder="Value" name="discountValue" min="0" value="{{ $discountList->discount_value }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 text-left">Date Validity</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="fromDate" name="fromDate" data-provide="datepicker" placeholder="From" value="{{ $discountList->start_date }}">
                            </div>
                            <div class="col-sm-1" style="text-align: center;">
                                <label><i class="fa fa-minus" aria-hidden="true"></i></label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" id="untilDate" name="untilDate" data-provide="datepicker" placeholder="Until" value="{{ $discountList->end_date }}">
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
                                <option value='"{{ $product->productid }}"' <?php if( in_array('"'.$product->productid.'"',explode(';',$discountList->product_id))){ echo 'selected="selected"';} ?>>{{ $product->producttitle }}</option>
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
                                <option value='"{{ $product_cat->categoryid }}"' <?php if( in_array('"'.$product_cat->categoryid.'"',explode(';',$discountList->category_id))){ echo 'selected="selected"';} ?>>{{ $product_cat->categorytitle }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Select Brands</label>
                        <div class="form-group" style="padding-left: 2%;">
                            <!-- Build your select: -->
                            <select name="brand[]" id="select-brands" multiple="multiple" style="width: 100%;">
                                @foreach($product_brands as $product_brands)
                                <option value='"{{ $product_brands->brandsid }}"' <?php if( in_array('"'.$product_brands->brandsid.'"',explode(';',$discountList->brands_id))){ echo 'selected="selected"';} ?>>{{ $product_brands->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 text-left">Stacked*</label>
                            <div class="col-sm-8">
                                    <span class="col-sm-3 text-left"><input type="radio" class="stacked-status" name="stacked-status" value="1" <?php if($discountList->stacked_status == "1"){echo 'checked';}?>> <strong>No</strong></span>
                                    <span class="col-sm-3 text-left"><input type="radio" class="stacked-status" name="stacked-status" value="0" <?php if($discountList->stacked_status == "0"){echo 'checked';}?>> <strong>Yes</strong></span>
                                <label id="var-warning" style="color: #f00; font-size: 8pt" hidden>
                                    **PLEASE FILL THIS FORM**
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                </form>
                <div class="box-footer">
                    <div class="col-md-12">
                        <button onclick="discountSubmit()" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/promo') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- Initialize the plugin: -->
<script>
    function discountSubmit() {
        var varStatus = $('input[name="var-status"]:checked').val();
        if ($('#discountName').val() == null || $('input[name="discountType"]:selected').val() == 0 || $('#discountValue').val() == null || $('input[name="stacked-status"]:checked').val() == null) {
            alert("Fill the form correctly");
            $('#var-warning').show();
        } else {
            if ($('#select-product').val() == null && $('#select-category').val() == null && $('#select-brands').val() == null) {
                alert("Fill the form correctly");
            } else {
                $('.discount-form').submit();
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
