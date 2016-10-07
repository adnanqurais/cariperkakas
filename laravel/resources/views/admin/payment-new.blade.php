@extends('admin/app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       New Payment
      <!--<small>advanced tables</small>-->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">New Payment </li>
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
                  <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                  {{ Session::get('success-delete') }}
              </div>
            @endif
            <table id="example1" class="table table-bordered table-striped table-rotation">
              <thead>
                <tr>
                  <th>ID</th>
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
                    <img src="{{ url('img/payment/'.$pay->image.'') }}" data-toggle="modal" data-target="#myModal" onclick="getPaymentImage(this)" width:60; height="auto"; style="cursor:pointer;">
                  <?php }else{ ?>
                    <img src="{{ url('img/no-image_1.jpg') }}" width:"60" height="auto">
                  <?php } ?>

                     &nbsp;</td>
                  <td data-label="Create at">{{ $pay->created_at }} &nbsp;</td>
                  <td data-label="Action">
                      <div class="btn-group">
                         <a href="#" title="Confirmation Payment" class="btn btn-primary btn-sm" onclick="if(confirm('Are you sure confirmation this payment?')) location.href='{{ URL::to('admin/payment/confirm/' . $pay->paymentid) }}'"><i class="icon ion-android-done"></i></a>&nbsp;
                         <a href="#" title="Reject" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/payment/reject/' . $pay->paymentid) }}'"><i class="icon ion-android-close"></i></a>&nbsp;
                      </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>ID</th>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bukti Pembayaran</h4>
      </div>
      <div class="modal-body">
        <img id="buktiBayar" style="width:100%;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
    function getPaymentImage(a){
        // alert(a.src);
        $('#buktiBayar').attr("src", a.src);
    }
</script>
@endsection
