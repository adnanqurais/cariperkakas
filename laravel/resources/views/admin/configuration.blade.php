@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Configuration 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Configuration </li>
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

                @if(Session::has('success-update'))    
                <div class="col-lg-12">                
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                        {{ Session::get('success-update') }}
                    </div>
                </div>
                @endif
                  
                <form class="form-horizontal" action="{{ url('admin/configuration') }}" method="post" enctype="multipart/form-data">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="logo" value="{{ $configuration->logo }}">
                <div class="box-body">
                    <div class="col-md-12">
                        
                    <div class="row">
                        <h3>Global Information</h3>
                        <hr>
                    </div>
                      <div class="row">

                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Url</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Url" name="url" value="{{ $configuration->url }}" required>
                            </div>
                        </div>                          
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Site Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Site Name" name="sitename"  value="{{ $configuration->sitename }}" required>
                            </div>
                        </div>                            
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Company Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Company Name" name="company" value="{{ $configuration->companyname }}" required>
                            </div>
                        </div>                     
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $configuration->email }}" required>
                            </div>
                        </div>       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Telephone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Telephone" name="telephone" value="{{ $configuration->telephone }}" required>
                            </div>
                        </div>           
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Address</label>
                            <div class="col-sm-9">
                              <textarea class="form-control" name="address">{{ $configuration->address }}</textarea>
                            </div>
                        </div>            
                                
                 


                      </div><!--./row-->

                             
                        <div class="row">
                            <h3>Mail Default</h3>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Checkout Header</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="checkoutheader" >{{ $configuration->checkoutmail_header }}</textarea>
                                   
                                </div>
                            </div>     
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Checkout Footer</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="checkoutfooter" >{{ $configuration->checkoutmail_footer }}</textarea>
                                   
                                </div>
                            </div>       
                             <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Register Header</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="registerheader" >{{ $configuration->registermail_header }}</textarea>
                                   
                                </div>
                            </div>     
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Register Footer</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="registerfooter" >{{ $configuration->registermail_footer }}</textarea>
                                   
                                </div>
                            </div>                         
                             <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Payment Header</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="paymentheader" >{{ $configuration->paymentmail_header }}</textarea>
                                   
                                </div>
                            </div>     
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 text-left">Payment Footer</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="paymentfooter" >{{ $configuration->paymentmail_footer }}</textarea>
                                   
                                </div>
                            </div>                                           
                        
                        </div>
                    </div><!--./Col--> 
                   
                   

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



    
@endsection
