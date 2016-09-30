@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Detail Orders
            <small>ID : #{{ $orders->invoiceid }}</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Detail Orders</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <form class="form-horizontal" action="{{ url('admin/order/new') }}" method="post">
            <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="orderid" name="orderid" value="{{ $orders->invoiceid }}">
            <input type="hidden" name="byusers" value="{{ $orders->byusers }}">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <table id="example3" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders_details as $details)
                      <tr>
                        <td data-label="Product Code">{{ $details->productcode }}<?php if($details->var_name != null || $details->var_name != 0 || $details->var_name != ""){echo " -"." ".$details->var_name;}?>&nbsp;</td>
                        <td data-label="Product Name">{{ $details->producttitle }} &nbsp;</td>
                        <td data-label="Qty">{{ $details->qty }} &nbsp;</td>
                        <td data-label="Subtotal" class="price_format">Rp {{ $details->subtotal }} &nbsp;</td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                          <td colspan="2">&nbsp;</td>
                          <td><strong>Total Goods Payment</strong></td>
                          <td class="price_format">Rp {{ $orders->total_product_payment }}</td>
                      </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>Discount</strong></td>
                            <td>Rp {{ $orders->disc }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>Shipping Cost</strong></td>
                            <td class="price_format">Rp {{ $orders->shippingcost }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>Total Payment</strong></td>
                            <td class="price_format">Rp {{ $orders->total }}</td>
                        </tr>
                    </tfoot>
                  </table>
                  <div class="row">
                      <div class="col-md-6">

                          <legend>Order Information</legend>
                          <div class="form-group">
                            <label class="col-sm-3">Order Date</label>
                            <div class="col-sm-9">
                              {{ $orders->orderdate }}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Disc</label>
                            <div class="col-sm-9 price_format">
                             Rp {{ $orders->disc }}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Biaya Pengiriman</label>
                            <div class="col-sm-9 price_format">
                             Rp {{ $orders->shippingcost }}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Total Payment</label>
                            <div class="col-sm-9 price_format">
                             {{ $orders->total }}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <?php
                                  if($orders->status==0){?>
                                    <div class="label label-warning">Pending</div>

                                  <?php } elseif($orders->status==1){?>

                                    <div class="label label-success">Processing</div>
                                  <?php } elseif($orders->status==2){?>

                                    <div class="label label-success">Delivering</div>
                                  <?php } elseif($orders->status==3){?>
                                    <div class="label label-success">Completed</div>
                                  <?php } elseif($orders->status==4){?>
                                    <div class="label label-danger">Canceled</div>
                                  <?php } ?>
                                <a class="btn btn-sm" data-toggle="modal" data-target="#statusModal" data-toggle="tooltip" onclick=""><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                            </div>
                            
                          </div>

                          <div class="form-group">
                            <label class="col-sm-3">Note</label>
                            <div class="col-sm-9">
                                <?php
                                    echo nl2br($orders->order_note, false);
                                ?>
                            </div>
                          </div>

                          <legend>Shipping Information</legend>
                          <div class="form-group">
                            <label class="col-sm-3">Kurir</label>
                            <div class="col-sm-9">
                                {{ $orders->shipping_courier }}
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Package</label>
                            <div class="col-sm-9">
                              {{ $orders->shippingpackage }}
                              <a class="btn btn-sm" data-toggle="modal" data-target="#myModal" data-toggle="tooltip"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>
                            </div>
                          </div>

                           <div class="form-group">
                            <label class="col-sm-3">No Resi</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="No Resi" value="{{ $orders->resi }}" name="resi" <?php if($orders->status==0){echo "readonly"; } ?>>
                            </div>
                          </div>

                           <div class="form-group">
                            <label class="col-sm-3">Delivery Date</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Delivery Date" data-provide="datepicker" name="deliverydate" value="<?php $now;?>" <?php if($orders->status==0){echo "readonly"; } ?>>
                            </div>
                          </div>

                      </div><!-- /.col -->
                      <div class="col-md-6">

                        <legend>Delivery to</legend>
                          <div class="form-group">
                            <label class="col-sm-3">Full Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Full Name" name="fullname" value="{{ $orders->order_fullname }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Email" name="fullname" value="{{ $orders->order_email }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Address</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" style="resize:vertical;" name="address" <?php if($orders->status==0){echo "readonly"; } ?> required>{{ $orders->order_address }}</textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Pos Code</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Pos Code" name="poscode" value="{{ $orders->order_poscode }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Province</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Province" name="province" value="{{ $orders->order_province }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">City</label>
                            <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="City" name="city" value="{{ $orders->order_city }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Subdistrict</label>
                            <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Subdistrict" name="subdistrict" value="{{ $orders->order_subdistrict }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3">Handphone</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" placeholder="Handphone" name="handphone" value="{{ $orders->order_handphone }}" <?php if($orders->status==0){echo "readonly"; } ?> required>
                            </div>
                          </div>
                      </div><!-- /.col -->
                  </div><!-- /.row -->

                </div><!-- /.box-body -->


                <div class="box-footer text-right">
                  <div class="col-sm-6" style="text-align:left;">
                    <a href="{{ url('invoice/'.$orders_details[0]->invoiceid) }}" class="btn" style="background-color:#222D32; color:#eee;">Download Invoice</a>
                    <a href="{{ url('deliveryNotes/'.$orders_details[0]->invoiceid) }}" class="btn" style="background-color:#222D32; color:#eee;" <?php if($orders->status==0){ echo "disabled"; } ?>>Delivery Notes</a>
                  </div>
                  <div class="col-sm-6 text-right">
                    <a href="{{ url('admin/order/new') }}" class="btn btn-default">Back</a>
                    <button type="submit" class="btn btn-primary" <?php if($orders->status==0){ echo "disabled"; } ?>>Save</button>
                  </div>
                </div>
                </div><!-- /.box -->

              </form>
            </div><!-- /.col -->
          </div><!-- /.row -->



        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!--Edit Package Modal Starts-->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button id="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Shipping Package</h4>
            </div>
            <div class="modal-body">
              <div class="clearfix">
                <div class="col-sm-12 form-group">
                  <label class="col-sm-3" for="newPackage">New Package</label>
                  <textarea class="col-sm-9" type="text" class="form-control" id="newPackage" style="resize: none; margin-top: 0px; margin-bottom: 0px">{{ $orders->shippingpackage }}</textarea>
                </div>
              </div>
              <div class="clearfix">
                <div class="col-sm-12 form-group">
                  <label class="col-sm-3" for="newPackage">Shipping Cost</label>
                  <input class="col-sm-9" type="text" class="form-control" id="newShippingCost" value="{{ $orders->shippingcost }}">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="postNewPackage()">Save</button>
            </div>
          </div>

        </div>
      </div>
      <!-- Modal Ends-->

      <!--Edit Status Modal Starts-->
      <div class="modal fade" id="statusModal" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button id="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Order's Status</h4>
            </div>
            <div class="modal-body">
              <div class="clearfix">
                <div class="col-sm-12 form-group">
                    <select name="orderStatus" class="form-control" style="text-transform:capitalize;">
                        @foreach($invoice_status as $invoice_stat)
                        <option value="{{ $invoice_stat->statusid }}" <?php if($orders->status == $invoice_stat->statusid){ echo 'selected="selected"';} ?> >{{ $invoice_stat->status_description }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" onclick="updateOrderStatus()">Save</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Ends-->
      <script>

          //===================================
          //=====UPDATE SHIPPING PACAKAGE======
          //===================================
          function postNewPackage() {
              var dataString = '_token=' + $('#token').val() + '&invoiceid=' + $('#orderid').val() + '&newShippingCost=' + $('#newShippingCost').val() + '&package=' + $('#newPackage').val();
              $.ajax({
                  type: "GET",
                  url: "{{ url('admin/ajax/order/new/package') }}",
                  data: dataString,
                  success: function(data) {
                      //alert(data);
                      location.reload();
                  },
                  error: function(data) {
                      alert("SOMETHINGS WRONG WITH YOUR AJAX");
                  }
              });

          }

          //==============================
          //=====UPDATE STATUS ORDER======
          //==============================
          function updateOrderStatus() {
              var token = $('#token').val();
              var orderStatus = $('[name="orderStatus"]').val();
              var dataString = '_token=' + token + '&orderStatus=' + orderStatus + '&invoiceid=' + $('#orderid').val();
              $.ajax({
                  type: "GET",
                  url: "{{ url('admin/ajax/order/status') }}",
                  data: dataString,
                  success: function(data) {
                      //alert(data);
                      location.reload();
                  },
                  error: function(data) {
                      alert("SOMETHINGS WRONG WITH YOUR AJAX");
                  }
              });
          }
      </script>
@endsection
