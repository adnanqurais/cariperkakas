@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inbox
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Inbox</li>
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


                @if(Session::has('success-email'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-email') }}
                    </div>
                @endif
                  <table id="example1" class="table table-bordered table-striped table-rotation">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Date Time</th>
                        <th>Status</th>
                        <th>From</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($inbox as $inb)
                      <tr>
                        <td data-label="ID">{{ $inb->messagesid }} &nbsp;</td>
                        <td data-label="Date Time">{{ $inb->datetime }} &nbsp;</td>
                        <td data-label="Status">{{ $inb->status }} &nbsp;</td>
                        <td data-label="From">{{ $inb->email }} &nbsp;</td>
                        <td data-label="Name">{{ $inb->name }} &nbsp;</td>
                        <td data-label="Message">{{ $inb->message }} &nbsp;</td>
                        <td data-label="Action">
                            <div class="btn-group">
                               <a href="{{ url('admin/inbox/replay/'.$inb->messagesid) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Reply"><i class="icon ion-reply"></i></a>
                               <a href="#" title="Delete" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="if(confirm('Are you sure?')) location.href='{{ URL::to('admin/inbox/delete/' . $inb->messagesid) }}'"><i class="icon ion-android-close"></i></a>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                      <tr>

                        <th>ID</th>
                        <th>Date Time</th>
                        <th>Status</th>
                        <th>From</th>
                        <th>Name</th>
                        <th>Message</th>
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
