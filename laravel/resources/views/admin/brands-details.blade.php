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
            <li class="active">Brands Details  </li>
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

                <form class="form-horizontal" action="{{ url('admin/brands/views') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="box-body">
                    <div class="col-md-6">
                      <div class="row">


                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Name" name="name" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-sm-3 text-left">Name</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left"></label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="enable" checked="1"> Enable
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 text-left">Featured</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="featured"> Enable
                            </div>
                        </div>
                      </div><!--./row-->

                    </div><!--./Col-->



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('admin/users') }}"class="btn btn-default">Back</a>
                    </div>
                </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->




@endsection
