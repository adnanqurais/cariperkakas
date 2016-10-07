@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             History Payment
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">History Payment </li>
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
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-delete') }}
                    </div>
                  @endif
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Bank Account</th>
                        <th>Bank</th>
                        <th>Email</th>
                        <th>Transfer Date</th>
                        <th>Ammount</th>
                        <th>Notes</th>
                        <th>Image</th>
                        <th>Create at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($payment as $pay)
                      <tr>
                        <td data-label="Order ID">#{{ $pay->invoiceid }} &nbsp;</td>
                        <td data-label="Status">
                          <?php
                            if($pay->status==1){?>
                              <div class="label label-warning">Pending</div>
                          <?php }elseif($pay->status==2){ ?>
                              <div class="label label-success">Confirmed</div>
                          <?php }elseif($pay->status==5){ ?>
                              <div class="label label-success">Declined</div>
                          <?php } ?>
                           &nbsp;</td>
                        <td data-label="Bank Account">{{ $pay->bankaccountname }} &nbsp;</td>
                        <td data-label="Bank">{{ $pay->bank }} &nbsp;</td>
                        <td data-label="Email">{{ $pay->email }} &nbsp;</td>
                        <td data-label="Transfer Date">{{ $pay->transferdate }} &nbsp;</td>
                        <td data-label="Ammount"><span  class="price_format">{{ $pay->transferammount }}</span> &nbsp;</td>
                        <td data-label="Notes">{{ $pay->notes }} &nbsp;</td>
                        <td data-label="Image">
                        <?php
                        if(!empty($pay->image)){?>
                          <img src="{{ url('img/payment/'.$pay->image.'') }}" width:60; height="auto">
                        <?php }else{ ?>
                          <img src="{{ url('img/no-image.jpg') }}" width:"60" height="auto">
                        <?php } ?>

                           &nbsp;</td>
                        <td data-label="Create at">{{ $pay->created_at }} &nbsp;</td>
                        <td data-label="Action">
                            <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/payment/history/delete/' . $pay->paymentid) }}'"><i class="icon ion-android-close"></i></a>&nbsp;
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Bank Account</th>
                        <th>Bank</th>
                        <th>Email</th>
                        <th>Transfer Date</th>
                        <th>Transfer Ammount</th>
                        <th>Notes</th>
                        <th>Image</th>
                        <th>Create at</th>
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
