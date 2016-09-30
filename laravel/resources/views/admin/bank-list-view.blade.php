@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Brands Details 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Bank Details  </li>
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
                  
                <form class="form-horizontal" action="{{ url('admin/bank/postview/'.$banks[0]->bank_id.'') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">
                                            
                                                 
                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Banks Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" name="banksname" value="{{ $banks[0]->bankname }}" >
                            </div>
                        </div>              
                                                              
                        <div class="form-group">
                            <label class="col-sm-3">Banks Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Account Number" name="banksAccountNumber" value="{{ $banks[0]->banknumber }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3">Banks Account Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Account Name" name="banksAccountName" value="{{ $banks[0]->bankholder }}" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3">Banks Location</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Banks Account Name" name="banksLocation" value="{{ $banks[0]->location }}" required>
                            </div>
                        </div>                          
                            
                        <div class="form-group">
                            <label class="col-sm-3">Logo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="banksLogoEdited">
                            </div>
                        </div>     
                      </div><!--./row-->
                    </div><!--./Col--> 
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/bank') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
