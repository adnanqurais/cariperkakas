@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Bank 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Bank </li>
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
                  
                <form class="form-horizontal" action="{{ url('admin/bank/add') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="col-sm-3">Banks Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Name" name="banksname" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3">Banks Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Account Number" name="banksAccountNumber" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3">Banks Account Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Account Name" name="banksAccountName" required>
                            </div>
                        </div>                          
                        <div class="form-group">
                            <label class="col-sm-3">Banks Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Location" name="banksLocation" required>
                            </div>
                        </div>                                                                  
                        <div class="form-group">
                            <label class="col-sm-3">Banks Logo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="banksLogo" required>
                                <!--<p class="help-block">Example block-level help text here.</p>-->
                            </div>
                        </div>       
                    </div><!--./Col--> 
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
