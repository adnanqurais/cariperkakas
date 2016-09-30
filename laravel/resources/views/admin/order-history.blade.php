@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            History Orders
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History Orders</li>
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
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>                 
                        <th>Order ID</th>
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
                        <td data-label="Order ID">#{{ $order->invoiceid }} &nbsp;</td>
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
                        <td data-label="By Users">{{ $order->order_email }} &nbsp;</td>                                
                        <td data-label="By Users">{{ $order->order_handphone }} &nbsp;</td>
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/order/detail/'.$order->invoiceid.'') }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View"><i class="icon ion-eye"></i></a>                            
                               <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/order/delete/' . $order->invoiceid) }}'"><i class="icon ion-android-close"></i></a>
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
@endsection