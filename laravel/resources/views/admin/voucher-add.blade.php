@extends('admin/app')
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Voucher 
            <!--<small>advanced tables</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Add Voucher  </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">                  
                <form class="form-horizontal" action="{{ url('admin/voucher/add') }}" method="post">               
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">   
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Limit</label>
                            <div class="col-sm-9">
                              <select name="type" class="form-control">
                                  <option value="1">Percent ( % )</option>
                                  <option value="2">Ammount ( Rp )</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Limit</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="Limit" name="limit" min="0" required>
                            </div>
                        </div>                                                      
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Value</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Value" name="value" required>
                            </div>
                        </div>       
                      </div><!--./row-->
                             
                    </div><!--./Col--> 
                   

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/voucher') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



    
@endsection
