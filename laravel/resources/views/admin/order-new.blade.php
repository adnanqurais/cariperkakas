@extends('admin/app')
@section('content')
       <style>
            .loadingGif {
                position: fixed;
                left: 0px;
                right: 0px;
                width: 100%;
                height: 100%;
                z-index: 1000000;
                background:50% 50% no-repeat rgba(255,255,255,0.4);
            }
            .loadingGif i {
                position: fixed;
                top: 50%;
                left: 50%;
                margin-top: -21px;
                margin-left: -21px;
                color: #1DB7EB;
            }
       </style>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            New Orders
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">New Orders</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title">Data Table With Full Features</h3>-->
                </div><!-- /.box-header -->
                <div class="box-body">                    
                  @if(Session::has('success-delete'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  @if(Session::has('success-update'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-update') }}
                    </div>
                  @endif
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                 
                        <th>Invoice ID</th>
                        <th>Date Order</th>
                        <th>Status</th>                                                                              
                        <th>By Users</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                      <tr>
                        <td data-label="Order ID">#{{ $order->invoiceid }} &nbsp;
                            <input type="hidden" class="form-control" placeholder="Pos Code" name="poscode" value="{{ $order->invoiceid }}">
                        </td>
                        <td data-label="Date Order">{{ $order->orderdate }} &nbsp;</td>
                        <td data-label="Status">
                          <?php
                          if($order->status==0){?>
                            <div class="label label-warning" style="text-transform: capitalize;">{{ $order->status_description }}</div>

                          <?php } elseif($order->status==4){?>

                            <div class="label label-danger" style="text-transform: capitalize;">{{ $order->status_description }}</div>

                          <?php } else {?>

                            <div class="label label-success" style="text-transform: capitalize;">{{ $order->status_description }}</div>
                          <?php } ?>
                          &nbsp;</td>
                        <td data-label="By Users">{{ $order->order_fullname }} &nbsp;</td>
                        <td data-label="Email">{{ $order->order_email }} &nbsp;</td> 
                        <td data-label="Handphone">{{ $order->order_handphone }} &nbsp;</td>                                
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/order/detail/'.$order->invoiceid.'') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View Details"><i class="icon ion-eye"></i></a>
                               <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#paymentModal" data-toggle="tooltip" title="Confirm Payment" onclick="getPaymentDetail({{$order->invoiceid}})"><i class="ion-android-done"></i></a>
                               <a href="#" title="Cancel" class="btn btn-warning btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/order/cancel/' . $order->invoiceid) }}'"><i class="icon ion-android-close"></i></a>
                               <!--<a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/order/delete/' . $order->invoiceid) }}'"><i class="icon ion-android-close"></i></a>-->
                            </div>
                           &nbsp;
                        </td>
                      </tr>    
                    @endforeach                      
                    </tbody>
                    <tfoot>
                      <tr>               
                        <th>Order ID</th>
                        <th>Date Order</th>
                        <th>Status</th>                                                                              
                        <th>By Users</th>                                                                            
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Modal START-->
      <div class="modal fade" id="paymentModal" role="dialog">
        <div class="loadingGif"><i class="fa fa-spinner fa-spin fa-3x"></i></div>
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button id="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Payment Confirmation</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
          </div>

        </div>
      </div>
<!-- Modal End-->
<script>
    //Ajax untuk mempilkan city
    function getPaymentDetail(id) {
        $('#loadingsub').fadeIn();
        var token = $('#token').val();
        var dataString = '_token=' + token + '&id=' + id;
        $.ajax({
            type: "GET",
            url: "{{ url('admin/ajax/confirm/payment') }}",
            data: dataString,
            success: function(data) {
                $('.loadingGif').fadeOut("normal");
               $('.modal-body').load(location.href + '.modal-body', function () {
                $('.modal-body').html(data);
                    $('.price_format').priceFormat();
                });
            }
        });
        //$('.modal-body').load('{{ url('admin/ajax/confirm/payment ? id = ')}}' + id, function() {
        //    $('.price_format').priceFormat();
        //});

    }
</script>
@endsection